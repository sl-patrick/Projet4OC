<?php

require_once './Model/Post.php';
require_once './Model/Comment.php';
require_once './Model/User.php';


class BackController {

    private $_post;
    private $_comment;
    private $_user;

    public function __construct()
    {
        $this->_post = new Post();
        $this->_comment = new Comment();
        $this->_user = new User();
    }

    public function addPostView() {
        require './View/addPostView.php';
    }

    public function addPost($title, $contents, $author) {
        //Ajouter un article.
        $verifyTitle = htmlspecialchars(strip_tags($title));
        $verifyContents = htmlspecialchars(strip_tags($contents));

        $post = $this->_post->addPost($verifyTitle, $verifyContents, $author);
        header('Location:./index.php?url=dashboard');

    }

    public function updatePost($postId) {

        $updateArticle = $this->_post->updatePost($postId);
        require './View/updatePost.php';
    }

    public function deletePostWithComments($postId) {
        echo 'passe 2';

        $deletePost = $this->_post->deletePost($postId);
        echo 'delete';
    }

    public function deleteComment() {}

    public function dashboard() {
        $articles = $this->_post->getPosts();
        $recentComments = $this->_comment->getLastComments();
        require './View/dashboard.php';
    }

    public function connectUser($pseudo, $password) {

        $verifyPseudo = htmlspecialchars(strip_tags($pseudo));
        $verifyPassword = htmlspecialchars(strip_tags($password));
        // $verifyPassword = htmlspecialchars(strip_tags(password_hash($password, PASSWORD_DEFAULT)));

        $user = $this->_user->checkUser($verifyPseudo, $verifyPassword);

        if ($user === false) {
            require './View/loginView.php';
        } else {
            header('Location:./index.php?url=dashboard');
            exit;
        }
    }

    public function logout() {
        session_destroy();

        header('Location:./index.php');
    }
    
}