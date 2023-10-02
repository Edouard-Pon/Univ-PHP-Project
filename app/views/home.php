<?php
class HomeView
{
    public function show($data): void
    {
        ob_start();
?>
<p>
    Home Page WIP<br>
    You are logged in as <?php echo $data['name'] ?><br>
    Email: <?php echo $data['email'] ?>
    Number: <?php echo $data['phone'] ?>
    Location: <?php echo $data['location'] ?>
    Gender: <?php echo $data['gender'] ?>
    Admin Status: <?php echo $data['admin'] ?>
    Last connection: <?php echo $data['lastco'] ?>
</p>
<?php
    }
}
?>
