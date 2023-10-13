<?php

declare(strict_types=1);

class Favorite
{
    private const DSN = 'mysql:host=engineer-internship-training_mysql_1;dbname=mydatabase;';
    private const DB_USER = 'myuser';
    private const DB_PASS = 'mypassword';

    /**
     * いいね情報を保存
     *
     * @param string $postId 投稿ID
     */
    public function save(int $postId): void
    {
        $pdo = $this->dbConnect();
        $query = "INSERT INTO favorites(`post_id`) VALUE($postId)";
        $pdo->query($query);
    }

    public function count(int $postId): int
    {
        $pdo = $this->dbConnect();
        $query = "SELECT COUNT(*) AS CNT FROM favorites";
        return 0;
        //return $pdo->query($query)[0]['CNT'];
    }

    /**
     * DBに接続したPDOを返却する
     *
     * @return PDO
     */
    private function dbConnect(): PDO
    {
        $pdo = new PDO(self::DSN, self::DB_USER, self::DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    }
}
