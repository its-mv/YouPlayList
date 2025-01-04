# import os
# from flask import Flask, render_template, request, jsonify
# import yt_dlp
# import re

# # Initialize Flask app
# app = Flask(__name__)

# # Global status variable to track download progress
# status = {
#     'current': '',
#     'error': '',
# }

# # Route to render the homepage
# @app.route('/')
# def home():
#     return render_template('index.html')

# # Route to download the playlist
# @app.route('/download', methods=['POST'])
# def download_playlist():
#     global status

#     # Get playlist title and URL from the form
#     title = request.form.get('title')
#     playlist_url = request.form.get('playlist_url')
#     print(playlist_url)

#     # Validate the playlist URL
#     youtube_playlist_regex = r'^https://www\.youtube\.com/playlist\?list=[a-zA-Z0-9_-]+$'
#     if not re.match(youtube_playlist_regex, playlist_url):
#         status['error'] = 'Invalid playlist URL. Please check and try again.'
#         return jsonify(status)

#     if not title or not playlist_url:
#         status['error'] = 'Missing playlist title or URL.'
#         return jsonify(status)

#     # Directory for saving the videos
#     download_path = f'{os.path.expanduser("~")}/Downloads/{title}'  # Use Downloads folder
#     os.makedirs(download_path, exist_ok=True)  # Create directory if it doesn't exist

#     try:
#         # yt-dlp download options
#         ydl_opts = {
#             'format': 'bestvideo+bestaudio/best',  # Download best available format
#             'merge_output_format': 'mp4',
#             'outtmpl': f'{download_path}/%(playlist_index)s_%(title)s.%(ext)s',  # Output format for video names
#         }

#         # Create the yt-dlp object and download the playlist
#         with yt_dlp.YoutubeDL(ydl_opts) as ydl:
#             ydl.download([playlist_url])

#         status['current'] = "Download complete!"
#     except Exception as e:
#         print(f"Error downloading playlist: {e}")
#         status['error'] = f"Failed to download playlist: {e}"

#     return jsonify(status)

# # Run the Flask app
# # if __name__ == "__main__":
# #     app.run(debug=True)

# if __name__ == "__main__":
#     app.run(debug=True, host="127.0.0.1", port=5000)

import os
from flask import Flask, render_template, request, jsonify
import yt_dlp
import re
import time
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Allow cross-origin requests

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/download', methods=['POST'])
def download_playlist():
    # Local status dictionary
    status = {'current': '', 'error': ''}

    # Get playlist title and URL
    title = request.form.get('title')
    playlist_url = request.form.get('playlist_url')

    # Input validation
    youtube_playlist_regex = r'^https://www\.youtube\.com/playlist\?list=[a-zA-Z0-9_-]+$'
    if not playlist_url or not re.match(youtube_playlist_regex, playlist_url):
        status['error'] = 'Invalid or missing playlist URL.'
        return jsonify(status)
    if not title:
        status['error'] = 'Missing playlist title.'
        return jsonify(status)

    # Create directory
    download_path = f'{os.path.expanduser("~")}/Downloads/{title}'
    os.makedirs(download_path, exist_ok=True)

    try:
        ydl_opts = {
            'format': 'bestvideo+bestaudio/best',
            'merge_output_format': 'mp4',
            'outtmpl': f'{download_path}/%(playlist_index)s_%(title)s.%(ext)s',
        }
        with yt_dlp.YoutubeDL(ydl_opts) as ydl:
            ydl.download([playlist_url])
        status['current'] = "Download complete!"
    except yt_dlp.utils.DownloadError as e:
        status['error'] = f"Download error: {e}"
        time.sleep(5)  # Wait for 5
    except Exception as e:
        status['error'] = f"An unexpected error occurred: {e}"

    return jsonify(status)

if __name__ == "__main__":
    app.run(debug=True, host="127.0.0.1", port=5000)
