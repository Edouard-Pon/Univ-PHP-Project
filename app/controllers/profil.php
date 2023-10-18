<?php
class ProfilController
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        (new ProfilView())->show();
    }
}
