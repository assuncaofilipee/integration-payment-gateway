<?php


namespace App\Models\SystemInfo;

trait SystemInfo
{

    /***
     * @param \DateTime $date
     * @return string
     */
    public function dateDiff(\DateTime $date)
    {
        $diff = $date->diff(new \DateTime());
        return "Cadastrado há $diff->days dias";
    }

}
