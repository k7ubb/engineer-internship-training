<?php

declare(strict_types=1);

require_once '/var/www/src/Controller/AppController.php';
require_once '/var/www/src/Model/Favorite.php';
require_once '/var/www/src/Model/Post.php';

class PostsController extends AppController
{
    /**
     * 投稿一覧画面を表示
     *
     * $postsは以下のような構造をした連想配列の配列
     * [
     *    ['id' => 1, 'name' => '佐藤', 'message' => 'こんにちは'],
     *    ['id' => 2, 'name' => '田中', 'message' => 'こんばんは'],
     *    ...以下繰り返し
     * ]
     */
    public function index(): void
    {
        $pageName = 'ジンギスカン Chat🥩';
        $this->assign('pageName', $pageName);

        $post = new Post();
        $posts = $post->fetch();

        $favorite = new Favorite();
        foreach($posts as $post) {
#            $post['favorite'] = $favorite->count($post['id']);
            $post['favorite'] = $post['id'];
        }
        
        $this->assign('posts', $posts);
        
        $this->show('Posts/index.php');

        return;
    }

    /**
     * 投稿を作成しDBに保存
     *
     * @return void
     */
    public function create(): void
    {
        $name = $this->request->getData('name');
        $message = $this->request->getData('message');

        $post = new Post();
        $post->save($name, $message);

        echo '更新に成功しました。';
    }

    /**
     * 投稿を編集する(ajax)
     *
     * @return void
     */
    public function edit(): void
    {
        $name = $this->request->getData('name');
        $message = $this->request->getData('message');
        $id = (int)$this->request->getData('id');

        $post = new Post();
        $post->update($id, $name, $message);
        echo '更新に成功しました。';
    }

    /**
     * 投稿を削除する
     *
     * @return void
     */
    public function delete(): void
    {
        $id = (int)$this->request->getData('id');

        $post = new Post();
        $post->delete($id);
        echo '削除に成功しました。';
    }

    /**
     * 投稿をいいねする
     *
     * @return void
     */
    public function favorite(): void
    {
        $id = (int)$this->request->getData('id');

        $favorite = new Favorite();
        $favorite->save($id);
        echo 'いいねに成功しました。';
    }
}
