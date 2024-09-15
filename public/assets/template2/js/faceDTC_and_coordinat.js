let image = '';
let isCameraOn = true;
let faceConfidence = 0;

async function loadModels() {
    const MODEL_URL = '/assets/models'; // Path to models directory
    try {
        await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
        await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
        await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
        console.log('Models loaded successfully.');
    } catch (error) {
        console.error('Error loading models:', error);
    }
}

async function detectFaces() {
    const input = document.getElementById('result');
    const canvas = document.getElementById('faceCanvas');

    if (!input || !canvas) {
        console.error('Image or canvas element not found.');
        return;
    }

    const displaySize = {
        width: input.width,
        height: input.height
    };
    faceapi.matchDimensions(canvas, displaySize);

    try {
        let fullFaceDescriptions = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors();
        fullFaceDescriptions = faceapi.resizeResults(fullFaceDescriptions, displaySize);

        faceapi.draw.drawDetections(canvas, fullFaceDescriptions);
        // faceapi.draw.drawFaceLandmarks(canvas, fullFaceDescriptions);

        // Calculate average face confidence
        if (fullFaceDescriptions.length > 0) {
            const detections = fullFaceDescriptions.map(fd => fd.detection.score);
            faceConfidence = Math.max(...detections); // Get the highest confidence
        } else {
            faceConfidence = 0; // No face detected
        }

        console.log('Face Confidence:', faceConfidence); // Log face confidence value
        document.getElementById('faceConfidence').value = faceConfidence; // Set the hidden input value

    } catch (error) {
        console.error('Error detecting faces:', error);
    }
}



Webcam.set({
    height: 400,
    width: 430,
    image_format: 'jpeg',
    jpeg_quality: 90,
    flip_horiz: true
});
Webcam.attach('#webcamCapture');


document.getElementById('takeSnapshot').addEventListener('click', async function () {
    if (isCameraOn) {
        Webcam.snap(async function(data_uri) {
            const resultImg = document.getElementById('result');
            const webcamCapture = document.getElementById('webcamCapture');
            const imageInput = document.getElementById('image');
            const canvas = document.getElementById('faceCanvas');

            // Set image src to the captured image
            imageInput.value = data_uri;
            resultImg.src = data_uri;

            // Hide webcam capture and show the captured image
            webcamCapture.style.display = 'none';
            resultImg.style.display = 'block';

            // Wait until the image is fully loaded
            resultImg.onload = async function() {
                // Ensure canvas matches the size of the image
                if (canvas) {
                    canvas.width = resultImg.width;
                    canvas.height = resultImg.height;
                    canvas.style.display = 'block'; // Show canvas
                }

                // Run face detection
                await detectFaces();
            };
        });
    } else {
        alert('Kamera belum dimulai.');
    }
});





document.getElementById('resetCamera').addEventListener('click', function () {
    if (!isCameraOn) {
        Webcam.attach('#webcamCapture');
        isCameraOn = true;
    }
    document.getElementById('webcamCapture').style.display = 'block';
    document.getElementById('result').style.display = 'none';
    // Clear the canvas
    const canvas = document.getElementById('faceCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
    }
});

// Load models when the page loads
window.onload = async function () {
    await loadModels();
};

window.onload = async function() {
    await loadModels();
    const webcamElement = document.getElementById('webcamCapture');
    if (webcamElement) {
        console.log('Element found:', webcamElement);
        Webcam.attach('#webcamCapture');
    } else {
        console.error('Element not found: #webcamCapture');
    }
};
