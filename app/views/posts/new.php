<div id="newPostForm">
    <h1>Créez votre post</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <textarea name = "text" placeholder="Texte"></textarea>
        <input type="text" name="title">
        <input type="file" name="image" required>
        <div>
            <button type="reset" onclick="hideNewPostForm();">Cancel</button>
            <button type="submit" name="post">Upload</button>
        </div>
    </form>
</div>
