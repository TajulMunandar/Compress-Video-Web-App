from flask import Flask, request, jsonify
from werkzeug.utils import secure_filename
import os
from flask_cors import CORS
import huffman

app = Flask(__name__)
CORS(app)
UPLOAD_FOLDER = "uploads"
app.config["UPLOAD_FOLDER"] = UPLOAD_FOLDER

# Create upload folder if it doesn't exist
if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)


@app.route("/compress", methods=["POST"])
def compress_video():
    if "file" not in request.files:
        return jsonify({"error": "Tidak ada file di request"}), 400

    file = request.files["file"]
    if file.filename == "":
        return jsonify({"error": "Tidak ada file yang dipilih"}), 400

    if file:
        # Secure filename and save to uploads folder
        filename = secure_filename(file.filename)
        filepath = os.path.join(app.config["UPLOAD_FOLDER"], filename)
        file.save(filepath)

        # Get original file size
        original_size = os.path.getsize(filepath)

        # Compress video using Huffman Coding
        huffman_coding = huffman.HuffmanCoding(filepath)
        compressed_file_path, process_graph_path = huffman_coding.compress()

        huffman_coding.decompress(compressed_file_path)

        # Get compressed file size
        compressed_size = os.path.getsize(compressed_file_path)

        return jsonify(
            {
                "message": "File berhasil dikompres",
                "compressed_file_path": compressed_file_path,
                "original_size": original_size,
                "compressed_size": compressed_size,
                "original_name": filename,
                "process_graph_path": process_graph_path,
            }
        )


if __name__ == "__main__":
    app.run(debug=True)
