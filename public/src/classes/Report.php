<?php

abstract class Report implements JsonSerializable
{
    private $reason;
    private $reporter;
    private $reporterCache = null;
    private $ID;
    private $resolved;

    const Type_UserReport = "User";
    const Type_PostReport = "Post";

    protected function __construct($ID, $reason, $reporter)
    {
        if ($reporter instanceof User)
        {
            $this->reporter = $reporter->getID();
            $this->reporterCache = $reporter;
        }
        else
            $this->reporter = $reporter;

        $this->ID = $ID;
        $this->reason = $reason;
    }

    public static function fromRow($row)
    {
        $row['type'] = trim($row['type']);
        if ($row['type'] == Report::Type_PostReport)
            return new PostReport($row['id'], $row['reason'], $row['reporter'], $row['target'], $row['resolved']);
        elseif ($row['type'] == Report::Type_UserReport)
            return new UserReport($row['id'], $row['reason'], $row['reporter'], $row['target'], $row['resolved']);
        else
            throw new Exception("Unknown report type : " . $row["type"] . " (should be " . Report::Type_UserReport . " or " . Report::Type_PostReport);
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getReporter()
    {
        if ($this->reporterCache == null)
            $this->reporterCache = User::fromID($this->reporter);

        return $this->reporterCache;
    }

    public function getReporterId()
    {
        return $this->reporter;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getResolved()
    {
        return $this->resolved;
    }
}

class PostReport extends Report
{
    private $postCache = null;
    private $post;

    public function __construct($ID, $reason, $reporter, $post, $resolved)
    {
        parent::__construct($ID, $reason, $reporter, $resolved);

        if($post instanceof Post)
        {
            $this->post = $post->getID();
            $this->postCache = $post;
        }
        else
            $this->post = $post;
    }

    public static function create($post, $reason, $reporter)
    {
        $reportId = uniqid();

        $SQL = "INSERT INTO " . TABLE_Report . " (ID, Type, Target, Reporter, Reason, Resolved) VALUES (:id, :type, :target, :reporter, :reason, :resolved)";
        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $reportId);
        $statement->bindValue(":type", Report::Type_PostReport);
        $statement->bindValue(":target", $post->getID());
        $statement->bindValue(":reporter", $reporter->getID());
        $statement->bindValue(":reason", $reason);
        $statement->bindValue(":resolved", false);
        $statement->execute();

        return new PostReport($reportId, $reason, $reporter, $post, false);
    }

    public function getSamePostReports()
    {
        $SQL = "SELECT * FROM " . TABLE_Report . " WHERE Type = :type AND Target = :target";
        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->bindValue(":type", Report::Type_PostReport);
        $statement->bindValue(":target", $this->getPostId());
        $statement->execute();

        $rows = $statement->fetchAll();
        if(!$rows)
            return array();

        $results = array();
        foreach($rows as $row)
            $results[] = Report::fromRow($row);

        return $results;
    }

    public function getPost()
    {
        if ($this->postCache == null)
            $this->postCache = Post::fromID($this->post);

        return $this->postCache;
    }

    public function getPostId()
    {
        return $this->post;
    }

    public static function resolveAll($post)
    {
        $SQL = "UPDATE " . TABLE_Report . " SET Resolved = true WHERE Type = :type AND Target = :target";
        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->bindValue(":type", Report::Type_PostReport);
        $statement->bindValue(":target", $post->getID());
        $statement->execute();

        return $statement->rowCount();
    }

    public static function getReports()
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Report . " WHERE Type = :type";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":type", Report::Type_PostReport );
        $statement->execute();

        $result = array();
        $rows = $statement->fetchAll();
        if (!$rows)
            return $result;

        foreach($rows as $row)
            array_push($result, PostReport::fromRow($row));

        return $result;
    }

    public function jsonSerialize()
    {
        return array("id" => $this->getID(),
            "type" => Report::Type_PostReport,
            "reason" => $this->getReason(),
            "reporter" => $this->getReporterId(),
            "post" => $this->getPostId());
    }
}

class UserReport extends Report
{
    private $userCache = null;
    private $user;

    public function __construct($ID, $reason, $reporter, $user, $resolved)
    {
        parent::__construct($ID, $reason, $reporter, $resolved);

        if($user instanceof User)
        {
            $this->user = $user->getID();
            $this->userCache = $user;
        }
        else
            $this->user = $user;
    }

    public static function create($user, $reason, $reporter)
    {
        $reportId = uniqid();

        $SQL = "INSERT INTO " . TABLE_Report . " (ID, Type, Target, Reporter, Reason) VALUES (:id, :type, :target, :reporter, :reason, :resolved)";
        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $reportId);
        $statement->bindValue(":type", Report::Type_UserReport);
        $statement->bindValue(":target", $user->getID());
        $statement->bindValue(":reporter", $reporter->getID());
        $statement->bindValue(":reason", $reason);
        $statement->bindValue(":resolved", false);
        $statement->execute();

        return new UserReport($reportId, $reason, $reporter, $user);
    }

    public function getUser()
    {
        if ($this->userCache == null)
            $this->userCache = User::fromID($this->user);

        return $this->userCache;
    }

    public function getUserId()
    {
        return $this->user;
    }

    public static function getReports()
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Report . " WHERE Type = " . Report::Type_UserReport;
        $statement = $db->prepare($SQL);
        $statement->execute();

        $result = array();
        $rows = $statement->fetchAll();
        if (!$rows)
            return $result;

        foreach($rows as $row)
            array_push($result, UserReport::fromRow($row));
    }

    public function jsonSerialize()
    {
        return array("id" => $this->getID(),
            "type" => Report::Type_UserReport,
            "reason" => $this->getReason(),
            "reporter" => $this->getReporterId(),
            "user" => $this->getUserId());
    }
}