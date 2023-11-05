const newPostForm = document.getElementById('newPostForm')
const closePostForm = document.getElementById('close-post-form')

//Lets user select "Add new category" makes little box appear to add new category
document.getElementById("categories").addEventListener("change", function () {
    var selectedCategory = this.value;
    var newCategoryInput = document.getElementById("newCategoryInput");

    if (selectedCategory === "new_category") {
        newCategoryInput.style.display = "block";
    } else {
        newCategoryInput.style.display = "none";
    }
});

function showNewPostForm() {
    newPostForm.style.display = 'block'
    closePostForm.style.display = 'block'
}

function hideNewPostForm() {
    newPostForm.style.display = 'none'
    closePostForm.style.display = 'none'
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

const navBar = document.getElementById('navBar')


function showNavBar() {
    navBar.style.display = "flex";
}

function hideNavBar() {
    navBar.style.display = "none";
}
