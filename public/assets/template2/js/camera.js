// let stream = null;
// const videoElement = document.getElementById('cameraPreview');
// const capturedImage = document.getElementById('capturedImage');
// const startButton = document.getElementById('startCamera');
// const captureButton = document.getElementById('capturePhoto');
// const retakeButton = document.getElementById('retakePhoto');
// const submitButton = document.getElementById('submitButton');
// const photoDataInput = document.getElementById('photoData');

// // Start camera
// startButton.addEventListener('click', async () => {
//     try {
//         stream = await navigator.mediaDevices.getUserMedia({ 
//             video: { 
//                 facingMode: 'user',
//                 width: { ideal: 1280 },
//                 height: { ideal: 720 }
//             } 
//         });
//         videoElement.srcObject = stream;
//         document.querySelector('.camera-container').style.display = 'block';
//         startButton.style.display = 'none';
//         captureButton.style.display = 'inline-block';
//         document.querySelector('.image-preview-container').style.display = 'none';
//         retakeButton.style.display = 'none';
//     } catch (err) {
//         console.error('Error:', err);
//         alert('Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin.');
//     }
// });

// // Capture photo
// captureButton.addEventListener('click', () => {
//     const canvas = document.createElement('canvas');
//     canvas.width = videoElement.videoWidth;
//     canvas.height = videoElement.videoHeight;
//     canvas.getContext('2d').drawImage(videoElement, 0, 0);
//     const imageData = canvas.toDataURL('image/png');
    
//     capturedImage.src = imageData;
//     photoDataInput.value = imageData;
    
//     document.querySelector('.camera-container').style.display = 'none';
//     document.querySelector('.image-preview-container').style.display = 'block';
//     captureButton.style.display = 'none';
//     retakeButton.style.display = 'inline-block';
//     submitButton.disabled = false;
    
//     // Stop camera stream
//     if (stream) {
//         stream.getTracks().forEach(track => track.stop());
//     }
// });

// // Retake photo
// retakeButton.addEventListener('click', async () => {
//     try {
//         stream = await navigator.mediaDevices.getUserMedia({ 
//             video: { 
//                 facingMode: 'user',
//                 width: { ideal: 1280 },
//                 height: { ideal: 720 }
//             } 
//         });
//         videoElement.srcObject = stream;
//         document.querySelector('.camera-container').style.display = 'block';
//         document.querySelector('.image-preview-container').style.display = 'none';
//         captureButton.style.display = 'inline-block';
//         retakeButton.style.display = 'none';
//         submitButton.disabled = true;
//         photoDataInput.value = '';
//     } catch (err) {
//         console.error('Error:', err);
//         alert('Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin.');
//     }
// });

// // Handle form submission
// function handleSubmit(event) {
//     event.preventDefault();
    
//     const formData = new FormData(document.getElementById('izinForm'));
    
//     fetch('/upload-file', {
//         method: 'POST',
//         body: formData,
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.message) {
//             alert(data.message);
//             if (data.message.includes('berhasil')) {
//                 location.reload();
//             }
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('Terjadi kesalahan saat mengirim data.');
//     });
// }

// // Clean up on modal close
// $('#FormulirModal').on('hidden.bs.modal', function () {
//     if (stream) {
//         stream.getTracks().forEach(track => track.stop());
//     }
//     document.querySelector('.camera-container').style.display = 'none';
//     document.querySelector('.image-preview-container').style.display = 'none';
//     startButton.style.display = 'inline-block';
//     captureButton.style.display = 'none';
//     retakeButton.style.display = 'none';
//     submitButton.disabled = true;
//     document.getElementById('izinForm').reset();
// });