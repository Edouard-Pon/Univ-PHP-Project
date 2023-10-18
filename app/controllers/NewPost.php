<?php
class NewPost
{

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(array $postData, array $fileData): void
    {
        $allowedImageFormats = array("jpg", "jpeg", "png", "gif");
        $errorMessage = '';
        $fileSizeLimitMB = [
            'image' => 5 * 1048576,
            'gif' => 15 * 1048576
        ];

        if (empty($_SESSION['username'])) {
            $errorMessage .= 'User session is not valid!';
        }

        if (isset($fileData['image']) && $fileData['image']['error'] === UPLOAD_ERR_OK) {
            $file_type = pathinfo($fileData['image']['name'], PATHINFO_EXTENSION);
            $file_name = $_SESSION['username'] . count(glob('posts/' . $_SESSION['username'] . '/*')) + 1 . '.' . $file_type;
            $file_size = $fileData['image']['size'];

            $data = [
                'dir' => 'posts/' . $_SESSION['username'] . '/',
                'file_name' => $file_name,
                'file_type' => $file_type,
                'file_size' => $file_size,
                'post_title' => htmlspecialchars($postData['title']),
                'post_text' => htmlspecialchars($postData['text']),
                'post_date' => date('Y-m-d h:i:s a', time()),
                'post_author' => htmlspecialchars($_SESSION['username'])
            ];

            error_log(json_encode($data));

            if (!is_dir($data['dir'])) {
                mkdir($data['dir'], 0777, true);
            }

            if (!in_array(strtolower($data['file_type']), $allowedImageFormats)) {
                $errorMessage .= 'Wrong file type!';
            }

            if ($data['file_size'] > $fileSizeLimitMB['image']) {
                $errorMessage .= 'Image size is to big!';
            }

            if (!empty($errorMessage)) {
                $_SESSION['errorMessage'] = $errorMessage;
            } else {
                if (move_uploaded_file($fileData['image']['tmp_name'], $data['dir'] . $data['file_name'])) {
                    $post = new Post($this->PDO);
                    $post->addPost($data);
                    header('Location: /home');
                    exit();
                } else {
                    $errorMessage .= 'Sorry, there was an error uploading your file';
                    $_SESSION['errorMessage'] = $errorMessage;
                }
            }
        }
    }
}
