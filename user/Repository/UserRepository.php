<?php

namespace Repository;

use Repository\Database\Connection;


class adminRepository
{

    private $Db, $Email, $PrimaryKey;

    public function __construct()
    {
        $this->Db = new Connection();
        $this->Email = 'Email';
        $this->PrimaryKey = 'Id';
        $this->van = 'van';
    }

    public function Insert($Fullname, $Email, $Password, $Phone)
    {
        $Insert = $this->Db->Connector("INSERT INTO user (Fullname,Email,Password,Phone) VALUES ('" . $Fullname . "','" . $Email . "','" . password_hash($Password, 1) . "','" . $Phone . "')");

        if ($Insert->rowCount() == 1)
            return true;
        else
            return false;
    }
    public function InsertDriver($Fullname, $Email, $Password, $Phone , $vannum)
    {
        $Insert = $this->Db->Connector("INSERT INTO user (Fullname,Email,Password,Phone,driver,vannum) VALUES ('" . $Fullname . "','" . $Email . "','" . password_hash($Password, 1) . "','" . $Phone . "' ,' " . 1 . "','" . $vannum . "')");

        if ($Insert->rowCount() == 1)
            return true;
        else
            return false;
    }

    public function BUY($Id)
    {
        $Result = $this->FindTicket($Id);
        if ($Result['capacity'] == 0) {
            echo "ظرفیت تکمیل است";
        } else {
            $tooken = (md5(date("U")));
            echo "خرید با موفقیت انجام شد بلیط شما <br>" . $tooken;
            $decreas = $Result['capacity'] - 1;
            $buy = $this->Db->Connector("UPDATE tickets SET capacity ='" . $decreas . "' WHERE {$this->PrimaryKey}={$Id}");
            if ($buy->rowCount() == 1) {
                session_start();
                $home = $Result["home"];
                $purpose = $Result["purpose"];
                $date = $Result['date'];
                $time = $Result["time"];
                $van = $Result["van"];
                $Email = $_SESSION['user'];
                $Insert = $this->Db->Connector("INSERT INTO final (home,purpose,Email,Tooken,date,time,van) VALUES ('" . $home . "','" . $purpose . "','" . $Email . "','" . $tooken . "','" . $date . "','" . $time . "','" . $van . "')");
                if ($Insert->rowCount() == 1)
                    return true;
                else
                    echo "اشکالی رخ داده است";
                header("refresh:2 , ../user/tickets.php");
            } else {
                echo "اشکالی رخ داده است";
                header("refresh:2 , ../user/tickets.php");
            }
        }
    }


    public function FindByEmail($Email)
    {
        $Email = $this->Db->Connector("SELECT * FROM user WHERE {$this->Email}='" . $Email . "'");
        return $Email->fetch();
    }

    public function FindById($Id)
    {
        $Email = $this->Db->Connector("SELECT * FROM user WHERE {$this->PrimaryKey}={$Id}");
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
    public function UserTickets()
    {
        $Email = $_SESSION['user'];
        $Email = $this->Db->Connector("SELECT * FROM final WHERE {$this->Email}='" . $Email . "'");
        return $Email->fetchAll();
    }public function DriverTicket()
    {
        if(isset($_SESSION['driver'])) {
            $van = $_SESSION['driver'];
            $van = $this->Db->Connector("SELECT * FROM final WHERE {$this->van}='" . $van . "'");
            return $van->fetchAll();
        }else{
            header("location:logout.php");
        }
    }

    public function FindTicket($Id)
    {
        $ticket = $this->Db->Connector("SELECT * FROM tickets WHERE {$this->PrimaryKey}={$Id}");
        return $ticket->fetch();
    }

    public function Login($Email, $Password)
    {
        $Result = $this->FindByEmail($Email);
        if ($Result != null) {
            if (password_verify($Password, $Result['Password']) == 1 && $Result['Status'] == 1) {
                session_start();
                echo "وارد شدید!";
                if ($Result['driver'] == 1) {
                    $_SESSION['driver'] = $Result['vannum'];
                    $hash = password_hash("driver", 1);
                    setcookie("user", $hash, time() + 60 * 60 * 24 * 365, "/", "moghisi.co");
                    header("refresh:2; url=./driver.php");
                }else{
                    $_SESSION['user'] = $Email;
                    $hash = password_hash("customer", 1);
                    setcookie("user", $hash, time() + 60 * 60 * 24 * 365, "/", "moghisi.co");
                    header("refresh:2; url=./tickets.php");
                }
            } elseif ($Result['Status'] == 0) {
                return "نام کاربری فعال نیست";
            } else {
                return 'نام کاربری یا رمز عبور اشتباه است';
            }
        } else {
            return 'کاربر وجود ندارد';
        }
    }
}