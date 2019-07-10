<?php

namespace Repository;

use Repository\Database\Connection;

class adminRepository
{
    private $Db, $Email, $PrimaryKey, $Date , $Time , $Van;

    public function __construct()
    {
        $this->Db = new Connection();
        $this->Email = 'Email';
        $this->PrimaryKey = 'Id';
        $this->Date = 'date';
        $this->Time = 'time';
        $this->Van = 'van';
    }

    public function Insert($Fullname, $Email, $Password, $Phone)
    {
        $Insert = $this->Db->Connector("INSERT INTO admins (Fullname,Email,Password,Phone) VALUES ('" . $Fullname . "','" . $Email . "','" . password_hash($Password, 1) . "','" . $Phone . "')");
        if ($Insert->rowCount() == 1)
            return true;
        else
            return false;
    }

    public function FindByDate($date)
    {
        $date = $this->Db->Connector("SELECT * FROM tickets WHERE {$this->Date}='" . $date . "'");
        return $date->fetch();
    }

    public function FindByTime($time)
    {
        $time = $this->Db->Connector("SELECT * FROM tickets WHERE {$this->Time}='" . $time . "'");
        return $time->fetch();
    }

    public function FindByVan($van)
    {
        $van = $this->Db->Connector("SELECT * FROM tickets WHERE {$this->Van}='" . $van . "'");
        return $van->fetch();
    }

    public function InsertTICKETS($home, $purpose, $date, $time, $van, $capacity)
    {
        $vancheck = $this->FindByVan($van);
        $datecheck = $this->FindByDate($date);
        $chechtime = $this->FindByTime($time);
        if ($vancheck != null && $datecheck != null && $chechtime != null){
                echo "ون در این زمان در دسترس نیست";
        }else{
            $Insert = $this->Db->Connector("INSERT INTO tickets (home,purpose,date,time,van,capacity) VALUES ('" . $home . "','" . $purpose . "','" . $date . "','" . $time . "','" . $van . "','" . $capacity . "')");
            if ($Insert->rowCount() == 1)
                return true;
            else
                return false;
        }
    }


    public function Update($Fullname, $Phone, $Status, $Id, $vanname)
    {
        $Update = $this->Db->Connector("UPDATE user SET vannum='" . $vanname . "', Fullname='" . $Fullname . "',Phone = '" . $Phone . "',Status = '" . $Status . "' WHERE {$this->PrimaryKey}={$Id}");
        if ($Update->rowCount() == 1)
            return true;
        else
            return false;
    }

    public function UpdateTicket($home, $purpose, $date, $time, $capacity, $Id)
    {
        $Update = $this->Db->Connector("UPDATE tickets SET home='" . $home . "', purpose='" . $purpose . "',date = '" . $date . "',time = '" . $time . "', capacity='" . $capacity . "' WHERE {$this->PrimaryKey}={$Id}");
        if ($Update->rowCount() == 1)
            return true;
        else
            return false;
    }

    public function FindByEmail($Email)
    {
        $Email = $this->Db->Connector("SELECT * FROM admins WHERE {$this->Email}='" . $Email . "'");
        return $Email->fetch();
    }

    public function FindById($Id)
    {
        $Email = $this->Db->Connector("SELECT * FROM user WHERE {$this->PrimaryKey}={$Id}");
        return $Email->fetch();
    }

    public function FindByIdTicket($Id)
    {
        $Email = $this->Db->Connector("SELECT * FROM tickets WHERE {$this->PrimaryKey}={$Id}");
        return $Email->fetch();
    }

    public function All()
    {
        $Email = $this->Db->Connector("SELECT * FROM user");
        return $Email->fetchAll();
    }

    public function AllTICKETS()
    {
        $Email = $this->Db->Connector("SELECT * FROM tickets");
        return $Email->fetchAll();
    }

    public function AllAdminTICKETS()
    {
        $Email = $this->Db->Connector("SELECT * FROM user");
        return $Email->fetchAll();
    }

    public function Login($Email, $Password)
    {
        $Result = $this->FindByEmail($Email);
        if ($Result != null) {
            if (password_verify($Password, $Result['Password']) == 1 && $Result['Status'] == 1) {
                $hash = password_hash("Admins", 1);
                setcookie("admin", $hash, time() + 60 * 60 * 24 * 365, "/", "moghisi.co");
                echo '[<a href="../admin/users.php">users</a>]';
                echo '[<a href="../admin/tickets.php">tickets</a>]';
            } elseif ($Result['Status'] != 1) {
                return "نام کابری غیر فعال است!";
            } else {
                return 'نام کاربری یا رمز عبور نامعتبر!!';
            }
        } else {
            return 'کاربر وچود ندارد';
        }
    }

    public function delete($Id)
    {
        $delete = $this->Db->Connector("DELETE FROM user WHERE {$this->PrimaryKey}={$Id}");
        header("refresh:2 ; url=../admin/users.php");
        if ($delete->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTickets($Id)
    {
        $delete = $this->Db->Connector("DELETE FROM tickets WHERE {$this->PrimaryKey}={$Id}");
        header("refresh:2 ; url=../admin/tickets.php");
        if ($delete->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
}