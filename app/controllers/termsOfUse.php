<?php
class TermsOfUseController
{
    public function execute(): void
    {
        (new TermsOfUseView())->show();
    }
}
?>
