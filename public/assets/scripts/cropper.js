const imageInput = document.getElementById('image-input')
const cropperWindow = document.getElementById('cropper-window')
let imageCon, imageConW, imageConH
function loadImage() {
    const selectedFile = imageInput.files[0];

    if (selectedFile) {
        if (selectedFile.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function () {
                    const width = img.width;
                    const height = img.height;

                    const vertical = (height > width)

                    const imageC = document.getElementById('image-con')
                    imageC.classList.toggle('crop-vertical', vertical);
                    imageC.classList.toggle('crop-horizontal', !vertical);

                    image.src = e.target.result;
                };
            };

            reader.readAsDataURL(selectedFile);
            cropperWindow.style.display = 'flex';
        } else {
            alert("Please select an image file.");
        }
    }
}

const cropBox = document.getElementById('crop-box')
let cropBoxSize = parseInt(getComputedStyle(cropBox).width)

document.getElementById('zoom-in').addEventListener('click', function () {
    cropBoxSize = parseInt(getComputedStyle(cropBox).width)
    cropBox.style.width = (cropBoxSize + 10) + 'px'
    cropBox.style.height = (cropBoxSize + 10) + 'px'
})

document.getElementById('zoom-out').addEventListener('click', function () {
    cropBoxSize = parseInt(getComputedStyle(cropBox).width)
    cropBox.style.width = (cropBoxSize - 10) + 'px'
    cropBox.style.height = (cropBoxSize - 10) + 'px'
})

let isDragging = false

cropBox.addEventListener('mousedown', (e) => {
    isDragging = true
    imageCon = document.getElementById('image-con')
    imageConW = parseInt(imageCon.getBoundingClientRect().width)
    imageConH = parseInt(imageCon.getBoundingClientRect().height)
})

document.addEventListener('mousemove', (e) => {
    if (isDragging) {
        const xMouse = parseInt(e.clientX)
        const yMouse = parseInt(e.clientY)
        const xBox = parseInt(imageCon.getBoundingClientRect().left)
        const yBox = parseInt(imageCon.getBoundingClientRect().top)
        const halfBox = cropBoxSize / 2
        const x = xMouse - xBox - halfBox
        const y = yMouse - yBox - halfBox

        console.log(`x: ${x}, y: ${y}`)
        console.log(`x: ${x + cropBoxSize} <= ${imageConW}`)
        console.log(`y: ${y + cropBoxSize} <= ${imageConH}`)

        document.getElementById('crop-x').value = x;
        document.getElementById('crop-y').value = y;

        if (x >= 0 && y >= 0 && x + cropBoxSize <= imageConW && y + cropBoxSize <= imageConH) {
            console.log('Should Move')
            cropBox.style.left = x + 'px'
            cropBox.style.top = y + 'px'
        }
    }
})

document.addEventListener('mouseup', () => {
    isDragging = false
    document.getElementById('crop-w').value = cropBoxSize;
    document.getElementById('image-w').value = imageConW;
    document.getElementById('image-h').value = imageConH;
})
