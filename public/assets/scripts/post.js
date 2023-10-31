const newPostForm = document.getElementById('newPostForm')

function showNewPostForm() {
    newPostForm.style.display = 'block'
}

function hideNewPostForm() {
    newPostForm.style.display = 'none'
}
const tx = document.getElementsByTagName("textarea");
for (let i = 0; i < tx.length; i++) {
    tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight+15) + "px;overflow-y:hidden;");
    tx[i].addEventListener("input", OnInput, false);
}

function OnInput() {
    this.style.height = 0;
    this.style.height = (this.scrollHeight) + "px";
}