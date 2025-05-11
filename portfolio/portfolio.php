<?php
require_once __DIR__ . '/../Database/database.php';
require_once __DIR__ . '/crud_status.php';
require_once __DIR__ . '/crud_portfolio.php';
require_once __DIR__ . '/crud_slambook.php';
require_once __DIR__ . '/crud_blog.php';

$error = '';
$success = '';
$userId = 1; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_status'])) {
        if (updateUserStatus($pdo, $_POST, $userId)) {
            $success = 'Status updated!';
        } else {
            $error = 'Failed to update status.';
        }
    }
    
    if (isset($_POST['upgrade_stat'])) {
      if (!upgradeStat($pdo, $_POST['upgrade_stat'], $userId)) {
          $error = 'Not enough points or invalid stat!';
      } else {
          $success = 'Stat upgraded!';
      }
  }
    
    if (isset($_POST['update_portfolio'])) {
        if (!updatePortfolio($pdo, $_POST['info'], $userId)) {
            $error = 'Failed to update portfolio.';
        } else {
            $success = 'Portfolio updated!';
        }
    }
    
    if (isset($_POST['add_slambook'])) {
        if (!addSlambookEntry($pdo, $_POST['question'], $_POST['answer'], $userId)) {
            $error = 'Failed to add slambook entry.';
        } else {
            $success = 'Slambook entry added!';
        }
    }
    if (isset($_POST['update_slambook'])) {
        if (!updateSlambookEntry($pdo, $_POST['id'], $_POST['question'], $_POST['answer'], $userId)) {
            $error = 'Failed to update slambook entry.';
        } else {
            $success = 'Slambook entry updated!';
        }
    }
    if (isset($_POST['delete_slambook'])) {
        if (!deleteSlambookEntry($pdo, $_POST['id'], $userId)) {
            $error = 'Failed to delete slambook entry.';
        } else {
            $success = 'Slambook entry deleted!';
        }
    }
    
    if (isset($_POST['add_blog'])) {
        if (!addBlogPost($pdo, $_POST['title'], $_POST['content'], $userId)) {
            $error = 'Failed to add blog post.';
        } else {
            $success = 'Blog post added!';
        }
    }
    if (isset($_POST['update_blog'])) {
        if (!updateBlogPost($pdo, $_POST['id'], $_POST['title'], $_POST['content'], $userId)) {
            $error = 'Failed to update blog post.';
        } else {
            $success = 'Blog post updated!';
        }
    }
    if (isset($_POST['delete_blog'])) {
        if (!deleteBlogPost($pdo, $_POST['id'], $userId)) {
            $error = 'Failed to delete blog post.';
        } else {
            $success = 'Blog post deleted!';
        }
    }
}

$user = getUserStatus($pdo, $userId);
$portfolio = getPortfolio($pdo, $userId);
if (!$user) {
    $pdo->prepare("INSERT INTO users (id, name, level, job, title, strength, agility, intelligence, sense, points, hp, mp)
        VALUES (?, 'PLAYER', 1, 'NONE', 'Beginner', 10, 10, 10, 10, 5, 100, 100)")
        ->execute([$userId]);
    $user = getUserStatus($pdo, $userId);
}

if (!$portfolio) {
    $pdo->prepare("INSERT INTO portfolio (user_id, info) VALUES (?, 'This is your portfolio info. Edit it!')")
        ->execute([$userId]);
    $portfolio = getPortfolio($pdo, $userId);
}
$slambook = getSlambookEntries($pdo, $userId);
$blog = getBlogPosts($pdo, $userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="portstyle.css">
</head>
<body>
    <a href="/Mainpage/maindash.php" class="back-btn">&larr; Back to Mainpage</a>
    <div class="header-container">
        <div class="header-window">
            <div class="login-content">
                <h2>WELCOME</h2>
                <h1>PLAYER</h1>
            </div>
        </div>
    </div>
    <?php if ($error): ?><div class="error-msg"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <?php if ($success): ?><div class="success-msg"><?=htmlspecialchars($success)?></div><?php endif; ?>
    <div class="windows-flex">

        <div class="status-window system-window">
            <div class="status-content">
                <h2>STATUS</h2>
                <form method="POST" class="form-row" style="flex-direction:column;align-items:flex-start;">
                    <label>Name: <input name="name" value="<?=htmlspecialchars($user['name'])?>"></label>
                    <label>Level: <input name="level" type="number" value="<?=$user['level']?>"></label>
                    <label>Job: <input name="job" value="<?=htmlspecialchars($user['job'])?>"></label>
                    <label>Title: <input name="title" value="<?=htmlspecialchars($user['title'])?>"></label>
                    <button name="update_status">Update</button>
                </form>
                <form method="POST" class="form-row" style="flex-direction:column;align-items:flex-start;">
                    <div>Strength: <?=$user['strength']?> <button name="upgrade_stat" value="strength" <?= $user['points'] <= 0 ? 'disabled' : '' ?>>+</button></div>
                    <div>Agility: <?=$user['agility']?> <button name="upgrade_stat" value="agility" <?= $user['points'] <= 0 ? 'disabled' : '' ?>>+</button></div>
                    <div>Intelligence: <?=$user['intelligence']?> <button name="upgrade_stat" value="intelligence" <?= $user['points'] <= 0 ? 'disabled' : '' ?>>+</button></div>
                    <div>Sense: <?=$user['sense']?> <button name="upgrade_stat" value="sense" <?= $user['points'] <= 0 ? 'disabled' : '' ?>>+</button></div>
                    <div>Points: <?=$user['points']?></div>
                </form>
                <div>HP: <?=$user['hp']??'N/A'?></div>
                <div class="bar-container"><div class="hp-bar" style="width:<?=isset($user['hp'])?min(100,($user['hp']/100))*1.0:'60'?>%"></div></div>
                <div>MP: <?=$user['mp']??'N/A'?></div>
                <div class="bar-container"><div class="mp-bar" style="width:<?=isset($user['mp'])?min(100,($user['mp']/100))*1.0:'90'?>%"></div></div>
                <div>PHYSICAL DAMAGE REDUCTION: 20% <span class="highlight">ACTIVATING</span></div>
            </div>
        </div>
       
        <div class="status-window system-window">
            <div class="status-content">
                <h2>PORTFOLIO INFO</h2>
                <form method="POST">
                    <textarea name="info" placeholder="Describe yourself..."><?=htmlspecialchars($portfolio['info']??'')?></textarea>
                    <button name="update_portfolio">Update Portfolio</button>
                </form>
            </div>
        </div>
        
        <div class="status-window system-window">
            <div class="status-content">
                <h2>SLAMBOOK</h2>
                <form method="POST" class="form-row">
                    <input name="question" placeholder="Question" required>
                    <input name="answer" placeholder="Answer" required>
                    <button name="add_slambook">Add</button>
                </form>
                <div>
                    <?php foreach ($slambook as $entry): ?>
                        <form method="POST" class="form-row">
                            <input type="hidden" name="id" value="<?=$entry['id']?>">
                            <input name="question" value="<?=htmlspecialchars($entry['question'])?>" required>
                            <input name="answer" value="<?=htmlspecialchars($entry['answer'])?>" required>
                            <button name="update_slambook">Update</button>
                            <button name="delete_slambook" onclick="return confirm('Delete this entry?')">Delete</button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="status-window system-window">
            <div class="status-content">
                <h2>BLOG MANAGER</h2>
                <form method="POST" class="form-row">
                    <input name="title" placeholder="Title" required>
                    <input name="content" placeholder="Content" required>
                    <button name="add_blog">Add</button>
                </form>
                <div>
                    <?php foreach ($blog as $post): ?>
                        <form method="POST" class="form-row" style="flex-direction:column;align-items:flex-start;">
                            <input type="hidden" name="id" value="<?=$post['id']?>">
                            <input name="title" value="<?=htmlspecialchars($post['title'])?>" required>
                            <textarea name="content" required><?=htmlspecialchars($post['content'])?></textarea>
                            <div style="display:flex;gap:0.5rem;">
                                <button name="update_blog">Update</button>
                                <button name="delete_blog" onclick="return confirm('Delete this post?')">Delete</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <audio id="error" src="https://www.myinstants.com/media/sounds/minecraft-hit-sound.mp3" preload="auto"></audio>
    <audio id="click" src="https://www.myinstants.com/media/sounds/minecraft-click.mp3" preload="auto"></audio>
    <audio id="beep" src="https://www.myinstants.com/media/sounds/beep-6-96243.mp3" preload="auto"></audio>
    <script src="portscript.js"></script>
</body>
</html> 