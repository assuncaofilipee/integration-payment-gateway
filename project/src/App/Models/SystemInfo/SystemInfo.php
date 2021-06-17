<?php


namespace App\Models\SystemInfo;

trait SystemInfo
{

    public function dateDiff(\DateTime $date)
    {
        $diff = $date->diff(new \DateTime());
        return "Cadastrado há $diff->days dias";
    }

}
