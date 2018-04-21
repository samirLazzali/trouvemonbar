<?php

abstract class Report
{
    private $reason;
    private $reporter;
    private $reporterCache;
    private $ID;

    static public const Type_UserReport = "User";
    static public const Type_PostReport = "Post";

    protected function __construct($ID, $reason, $reporter)
    {
        if ($reporter instanceof User)
        {
            $this->reporter = $reporter->getID();
            $this->reporterCache = $reporter;
        }
        else
            $this->reporter = $reporter;

        $this->reason = $reason;
    }
}

class Post extends Report
{
    private $postCache;
    private $post;

    public function __construct($ID, $reason, $reporter, $post)
    {
        parent::__construct($ID, $reason, $reporter);

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

        $SQL = "INSERT INTO " . TABLE_Report . " (ID, Type, Target, Reporter, Reason) VALUES (:id, :type, :target, :reporter, :reason)";
        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $reportId);
        $statement->bindValue(":type", Report::Type_PostReport);
        $statement->bindValue(":target", $post->getID());
        $statement->bindValue(":reporter", $reporter->getID());
        $statement->bindValue(":reason", $reason);
        $statement->execute();

        return new PostReport($reportId, $reason, $reporter, $post);
    }
}

class UserReport extends Report
{
    private $userCache;
    private $user;

    public function __construct($ID, $reason, $reporter, $user)
    {
        parent::__construct($ID, $reason, $reporter);

        if($user instanceof User)
        {
            $this->user = $user->getID();
            $this->userCache = $user;
        }
        else
            $this->user = $user;
    }
}