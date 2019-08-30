from flask import Flask
app = Flask(__name__)

@app.route("/")
def hello():
    return "Hello World!"

# Default port is 5000, and not allow external access
if __name__ == "__main__":
    app.run()

# Set port 80 and 0.0.0.0 allow access to external requests
# if __name__ == '__main__':
#     app.run(host='0.0.0.0', port=80)