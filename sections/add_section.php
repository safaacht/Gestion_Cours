<?php 
include('../includes/header.php');
include('../includes/connect_php.php');
include('../includes/helper.php');



if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $content=$_POST['content']; 
    $position=$_POST['position'];
    
    if (!input_valid($title) || !input_valid($content) || !input_valid($position) || !is_numeric($position) || $position <= 0) {
        echo "Invalid input.";
        exit;
    }
    
    $cid=$_GET['course_id'];
    $rqt="INSERT INTO sections(courses_id,title,content,position) VALUES(?,?,?,?)";
    
    $stmt=mysqli_prepare($connect,$rqt);
    mysqli_stmt_bind_param($stmt,'issi',$cid,$title,$content,$position);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("Location: ../sections/sections_list.php?course_id=$cid"); 
    exit;

    }

?>


<section>
    <form id="my-form"  method="POST">
    <h4>ADD Section</h4>
    <label>Title:</label>
    <input type="text" name="title" id="title">
    <label>Content:</label>
    <input type="text" name="content" id="content">
    <label>Position:</label>
    <input type="number" name="position" id="position">

    <button id="submit" name="submit">Submit</button>
    </form>
</section>
<script>
form=document.getElementById('my-form');

form.addEventListener('submit',(e)=>{
    // e.preventDefault();
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    const position = document.getElementById('position').value.trim();

    let errors = [];

    if (!title) {
        errors.push("Title is required!");
    }

    if (!content) {
        errors.push("Content is required!");
    }

    if (!position|| isNaN(position) || Number(position) <= 0) {
        errors.push("Position is invalid!");
    }


    if (errors.length > 0) {
        alert(errors.join("\n")); 
    }
});
</script>

<?php include '../includes/footer.php' ?>