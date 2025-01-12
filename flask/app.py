from flask import Flask, request, send_from_directory, url_for, jsonify
from flask_cors import CORS
import cv2
import numpy as np
import os
import re
import subprocess
import heapq
from collections import defaultdict
import matplotlib
matplotlib.use('Agg')  # Ensure this is at the top
import matplotlib.pyplot as plt

app = Flask(__name__, static_folder='static')
CORS(app)
UPLOAD_FOLDER = 'flask/uploads'
STATIC_FOLDER = 'flask/static'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['STATIC_FOLDER'] = STATIC_FOLDER
app.config['ALLOWED_EXTENSIONS'] = {'mp4', 'mkv', 'mov'}

class HuffmanNode:
    def __init__(self, char, freq):
        self.char = char
        self.freq = freq
        self.left = None
        self.right = None

    def __lt__(self, other):
        return self.freq < other.freq

def build_huffman_tree(data):
    freq = defaultdict(int)
    for byte in data:
        freq[byte] += 1

    priority_queue = [HuffmanNode(byte, freq) for byte, freq in freq.items()]
    heapq.heapify(priority_queue)

    while len(priority_queue) > 1:
        left = heapq.heappop(priority_queue)
        right = heapq.heappop(priority_queue)

        merged = HuffmanNode(None, left.freq + right.freq)
        merged.left = left
        merged.right = right

        heapq.heappush(priority_queue, merged)

    return priority_queue[0]

def generate_huffman_codes(node, prefix="", codebook={}):
    if node is None:
        return codebook

    if node.char is not None:
        codebook[node.char] = prefix

    generate_huffman_codes(node.left, prefix + "0", codebook)
    generate_huffman_codes(node.right, prefix + "1", codebook)

    return codebook

def compress(data):
    if not data:
        raise ValueError("Cannot compress empty data")

    tree = build_huffman_tree(data)
    codes = generate_huffman_codes(tree)

    compressed = ''.join([codes[byte] for byte in data])
    padding = 8 - len(compressed) % 8
    compressed += '0' * padding

    compressed_bytes = bytearray()
    for i in range(0, len(compressed), 8):
        compressed_bytes.append(int(compressed[i:i+8], 2))

    return compressed_bytes, codes, padding

def decompress(compressed_bytes, codes, padding):
    compressed = ''.join([f"{byte:08b}" for byte in compressed_bytes])
    compressed = compressed[:-padding]

    reverse_codes = {v: k for k, v in codes.items()}
    current_code = ""
    decompressed_data = []

    for bit in compressed:
        current_code += bit
        if current_code in reverse_codes:
            decompressed_data.append(reverse_codes[current_code])
            current_code = ""

    return bytes(decompressed_data)

def extract_audio(input_video_path, audio_output_path):
    """Ekstrak audio dari video asli menggunakan ffmpeg."""
    command = [
        'ffmpeg',
        '-i', input_video_path,          # Input video
        '-vn',                           # No video
        '-acodec', 'aac',                # Gunakan codec audio AAC
        '-ab', '192k',                   # Set bitrate audio
        '-ar', '44100',                  # Set sample rate
        '-y', audio_output_path          # Output audio file path
    ]
    subprocess.run(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE)

def add_audio_to_video(video_input_path, audio_input_path, output_video_path):
    """Gabungkan audio dengan video terkompresi menggunakan ffmpeg."""
    command = [
        'ffmpeg',
        '-i', video_input_path,          # Input video
        '-i', audio_input_path,          # Input audio
        '-c:v', 'copy',                  # Salin video codec tanpa kompresi ulang
        '-c:a', 'aac',                   # Gunakan codec audio AAC
        '-strict', 'experimental',       # Mengizinkan format audio eksperimental
        '-y', output_video_path          # Output video dengan audio
    ]
    subprocess.run(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE)

def compress_video(input_video_path, output_video_path, codec='mp4v', userId=0, count=0):
    file_extension = input_video_path.rsplit('.', 1)[1].lower()

    cap = cv2.VideoCapture(input_video_path)
    if not cap.isOpened():
        raise FileNotFoundError(f"Cannot open video file: {input_video_path}")

    # Ekstrak audio dari video asli
    audio_file_path = os.path.join(app.config['UPLOAD_FOLDER'], f'audio_{userId}_{count}.aac')
    extract_audio(input_video_path, audio_file_path)

    total_frames = int(cap.get(cv2.CAP_PROP_FRAME_COUNT))
    frame_width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
    frame_height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
    fps = cap.get(cv2.CAP_PROP_FPS)
    original_duration = total_frames / fps
    target_resolution=( int(frame_width * 0.15), int(frame_height * 0.15))
    desired_width, desired_height = target_resolution
    fourcc = cv2.VideoWriter_fourcc(*codec)
    out = cv2.VideoWriter(output_video_path, fourcc, fps, (desired_width, desired_height))

    processed_frames = 0
    frame_counter = 0
    last_valid_frame = None
    time_per_frame = 1 / fps
    actual_time = 0.0

    original_sizes = []
    compressed_sizes = []

    try:
        while cap.isOpened() and actual_time < original_duration:
            ret, frame = cap.read()
            if not ret:
                print(f"Frame {frame_counter + 1} could not be read. Using last valid frame as dummy.")
                dummy_frame = last_valid_frame if last_valid_frame is not None else np.zeros((desired_height, desired_width, 3), dtype=np.uint8)
                original_size = dummy_frame.nbytes
                original_sizes.append(original_size)
                compressed_sizes.append(original_size) # Menggunakan ukuran original sebagai fallback untuk grafik
                out.write(dummy_frame)
                actual_time += time_per_frame
                continue

            resized_frame = cv2.resize(frame, (desired_width, desired_height))

            # Menghitung ukuran frame original
            original_size = resized_frame.nbytes
            original_sizes.append(original_size)

            frame_data = resized_frame.tobytes()
            compressed_data, codes, padding = compress(frame_data)
            decompressed_data = decompress(compressed_data, codes, padding)

            decompressed_frame = np.frombuffer(decompressed_data, dtype=np.uint8)
            expected_size = np.prod(resized_frame.shape)

            if decompressed_frame.size != expected_size:
                print(f"Decompressed data size mismatch for frame {frame_counter + 1}. Using last valid frame as fallback.")
                if last_valid_frame is not None:
                    out.write(last_valid_frame)
                actual_time += time_per_frame
                frame_counter += 1
                continue

            # Menghitung ukuran frame yang terkompresi
            compressed_size = len(compressed_data)
            compressed_sizes.append(compressed_size)

            print(f"Decompressed succes in frame {frame_counter + 1} from {total_frames} total frame")
            decompressed_frame = decompressed_frame.reshape(resized_frame.shape)
            out.write(decompressed_frame)
            last_valid_frame = decompressed_frame.copy()
            actual_time += time_per_frame
            processed_frames += 1
            frame_counter += 1

    finally:
        cap.release()
        out.release()
        print(f"Video processing complete. Processed {processed_frames}/{total_frames} frames.")
        print(f"Original duration: {original_duration:.2f}s, Output duration: {actual_time:.2f}s")

        # Gabungkan audio kembali ke video terkompresi
        final_output_path = os.path.join(app.config['STATIC_FOLDER'], f'final_compressed_video_{userId}_{count}.{file_extension}')
        add_audio_to_video(output_video_path, audio_file_path, final_output_path)

        # Hapus file audio sementara setelah digunakan
        os.remove(audio_file_path)
        os.remove(output_video_path)

        # Plot ukuran original vs ukuran terkompresi
        plt.figure(figsize=(10, 6))
        plt.plot(original_sizes, label="Original Frame Size", color="blue", linestyle='-', linewidth=2)
        plt.plot(compressed_sizes, label="Compressed Frame Size", color="red", linestyle='-', linewidth=2)
        plt.xlabel("Frame")
        plt.ylabel("Size (bytes)")
        plt.title("Original vs Compressed Frame Sizes")
        plt.legend()
        graph_path = os.path.join(app.config['STATIC_FOLDER'], f'compressed_video_{userId}_{count}.jpeg')
        plt.savefig(graph_path)
        plt.close()

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in app.config['ALLOWED_EXTENSIONS']

@app.route('/compress', methods=['POST'])
def upload_video():
    file = request.files.get("file")
    userId = request.form.get("userId")
    count = request.form.get("count")
    if not file or file.filename == '':
        return jsonify({"error": "No file selected"}), 400

    if allowed_file(file.filename):
        # Save the file
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
        file.save(filepath)

        # Validate file size (20 MB = 20 * 1024 * 1024 bytes)
        max_file_size = 20 * 1024 * 1024
        file_size = os.path.getsize(filepath)

        if file_size > max_file_size:
            os.remove(filepath)  # Clean up the temporary file
            return jsonify({"error": "File size exceeds 20 MB. Please upload a smaller file."}), 400


        file_extension = file.filename.rsplit('.', 1)[1].lower()
        codec = {'mp4': 'mp4v', 'mkv': 'XVID', 'mov': 'mp4v'}.get(file_extension, None)

        # Dapatkan ukuran file asli
        original_size = os.path.getsize(filepath)


        if codec is None:
            return jsonify({"error": "Unsupported file format"}), 400  # Error dalam format JSON

        videoname = file.filename
        # Menggunakan os.path.splitext untuk menghapus ekstensi
        file_name_no_ext = os.path.splitext(videoname)[0]
        output_filename = os.path.join(app.config['STATIC_FOLDER'], f'compressed_video_{userId}_{count}.{file_extension}')

        try:
            compress_video(filepath, output_filename, codec, userId, count)
            # URL file untuk akses di Laravel
            # Nama file terkompresi
            compressed_name = f"final_compressed_video_{userId}_{count}.{file_extension}"
            compressed_path = os.path.join(app.config['STATIC_FOLDER'], compressed_name)
            # Dapatkan ukuran file terkompresi
            compressed_size = os.path.getsize(compressed_path)
            compressed_url = url_for('static', filename=f'{compressed_name}', _external=True)
            graph_url = url_for('static', filename=f'compressed_video_{userId}_{count}.jpeg', _external=True)
            return jsonify(
                {
                    "message": "File berhasil dikompres",
                    "compressed_file": compressed_url,
                    "original_size": original_size,
                    "compressed_size": compressed_size,
                    "original_name": file_name_no_ext,
                    "grafic_file": graph_url,
                }
            )

        except Exception as e:
            print(f"Error during video compression: {e}")
            return jsonify({"error": f"An error occurred during video compression: {str(e)}"}), 500  # Error dalam format JSON

    return jsonify({"error": "Unsupported file format. Only mp4, mov, and mkv are allowed."}), 400  # Error dalam format JSON

@app.route('/download', methods=['POST'])
def download_file():
    # Ambil video_id dari form data
    video_id = request.form.get('video_id')

    if video_id:
        # Pangkas URL dan ambil bagian setelah 'static/'
        # Misalnya: http://127.0.0.1:5000/static/your/video.mp4 menjadi your/video.mp4
        video_path = video_id.replace('http://127.0.0.1:5000/static/', '')  # Ganti dengan URL absolut yang sesuai
        try:
            # Kirimkan file dari folder static
            return send_from_directory('static', video_path, as_attachment=True)
        except FileNotFoundError:
            return 'File tidak ditemukan', 404
    else:
        return 'Data tidak valid', 400


if __name__ == '__main__':
    os.makedirs(UPLOAD_FOLDER, exist_ok=True)
    os.makedirs(STATIC_FOLDER, exist_ok=True)
    app.run(debug=True)
