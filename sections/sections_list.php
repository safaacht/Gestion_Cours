<?php 
require 'connect_php.php'; 
include 'header.php';
$cid=$_GET['course_id'];
$course=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM courses WHERE id=$cid"));
$res=mysqli_query($connect,"SELECT * FROM sections WHERE course_id=$cid ORDER BY position ASC");
?>
<h2>Sections - <?= $course['title'] ?></h2>
<a href='sections_create.php?course_id=<?= $cid ?>'>Ajouter section</a>
<table border='1'>
<tr><th>ID</th><th>Titre</th><th>Pos</th><th>Content</th><th>Actions</th></tr>
<?php while($s=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?= $s['id'] ?></td>
<td><?= htmlspecialchars($s['title'])?></td>
<td><?= $s['position']?></td>
<td><?= htmlspecialchars($s['content']) ?></td>
<td>
<a href='sections_edit.php?id=<?= $s['id'] ?>'>Update</a>
<a href='sections_delete.php?id=<?= $s['id'] ?>&course_id=<?= $cid ?>'>Delete</a>
</td>
</tr>
<?php }?>
</table>
<?php include 'footer.php' ?>