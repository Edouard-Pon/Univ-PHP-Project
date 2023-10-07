<?php
class CreatePost
{

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }
    public function execute(): void
    {
        (new CreatePostView())->show();
    }
}
?>
