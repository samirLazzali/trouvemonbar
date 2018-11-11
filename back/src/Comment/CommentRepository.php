<?php
namespace Comment;

class CommentRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->userRepository = new \User\UserRepository($connection);
    }

    public function createComment($comment)
    {
        $idUser = $comment->getIdUser();
        $idBar = $comment->getIdBar();
        $content = $comment->getContent();
        $dateCom = $comment->getDate();

        $stmt = $this->connection->prepare('INSERT INTO "comment"(idUser, idBar, content, dateCom) VALUES (:idUser, :idBar, :content, :dateCom)');
        $stmt->bindParam(':idUser', $idUser, \PDO::PARAM_INT);
        $stmt->bindParam(':idBar', $idBar, \PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmt->bindParam(':dateCom', $dateCom, \PDO::PARAM_STR);

        return $stmt->execute();
    }


    public function deleteComment($id)
    {
        if(!(isset($id))){
            return False;
        }
        $stmt = $this->connection->prepare('DELETE FROM "comment" where id=:id');
        $stmt->bindParam(':id',$id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateComment($comment)
    {
        $idUser = $comment->getIdUser();
        $idBar = $comment->getIdBar();
        $content = $comment->getContent();
        $dateCom = $comment->getDate();

        if(!(isset($idUser) && isset($idBar))){
            return False;
        }

        $stmt = $this->connection->prepare('UPDATE "comment" SET content=:content , dateCom=:dateCom where idUser=:idUser AND idBar=:idBar');
        $stmt->bindParam(':content',$content, \PDO::PARAM_STR);
        $stmt->bindParam(':dateCom',$dateCom, \PDO::PARAM_STR);
        $stmt->bindParam(':idUser',$idUser, \PDO::PARAM_INT);
        $stmt->bindParam(':idBar',$idBar, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function fetchByIdBar($idBar)
    {
        $request = $this->connection->prepare('SELECT * FROM comment WHERE idBar = :id');
        $request->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
        $request->bindParam(':id', $idBar, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $comments = $request->fetchAll(\PDO::FETCH_CLASS);
        if (!$comments) return null;
        foreach($comments as $comment) {
            $comment->pseudo = $this->userRepository->fetchById($comment->iduser)->getPseudo();
        }
        return $comments;
    }

    public function isSoloCom(Comment $comment)
    {
        $idBar = $comment->getIdBar();
        $idUser = $comment->getIdUser();
        $stmt = $this->connection->prepare('SELECT count(*) FROM "comment" WHERE idUser = :idUser AND idBar = :idBar');
        $stmt->bindParam(':idUser', $idUser, \PDO::PARAM_STR);
        $stmt->bindParam(':idBar', $idBar, \PDO::PARAM_STR);
        if (!$stmt->execute()) return false;

        return $stmt->fetchColumn() < 1;


    }

    public function fetchAll()
    {
        $stmt = $this->connection->query('SELECT id,idBar,idUser,content,dateCom FROM comment');
        if (!$stmt) {
            return false;
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Comment::class);
    }
}
