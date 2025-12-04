<?php include('header.php') ?>
<?php 



if(isset($_POST['submit'])){
    
    echo $_POST['title'] ."<br>";
    echo $_POST['description'];
    // echo $_GET['level'];
}

?>

<section>
    <form id="my_form" action="add_course.php" method="POST">
    <h4>ADD COURSE</h4>
    <label id="lateral_title">Title:</label>
    <input id="title" type="text" name="title">
    <label>Description:</label>
    <input id="description" type="text" name="description">
    <label>Level:</label>
    <select id="level" name="level" required>
        <option value="">--CHOOSE ONE--</option>
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
    </select>
    <label>Created at:</label>
    <input id="created_at" type="datetime-local" name="created_at">
    <!-- <button  name="mode">Change mode</button> -->
    <button id="submit" name="submit">Submit</button>
    </form>
</section>

<script>
    const form=document.querySelector("#my_form")
    const title=document.querySelector("#title");
    const description=document.querySelector("#description");
    const level=document.querySelector("#level");
    const createdAt=document.querySelector("#created_at");
    const submit=document.querySelector("#submit");

    const lateralTitle=document.querySelector("#lateral_title")


    
    submit.addEventListener("click",(e)=>{
        // console.log("aaaaaaa")
        // e.preventDefault();
        const errors=[];
        
    if(!title.value.trim()) errors.push("Title is required");
    if(!description.value.trim()) errors.push("Description is required");
    if(!createdAt.value.trim()) errors.push("Date & Time are required");
    if(level=='') errors.push("Level is required");

    console.log(errors);

    
    if(document.querySelector(".hadi")){      
        document.querySelector(".hadi").remove();    
    }
    const ul=document.createElement("ul");
    ul.classList.add("hadi");
    // ul.innerHTML = "";
    errors.forEach(error=>{
        const li=document.createElement("li");
        li.textContent+=error;
        ul.appendChild(li);
    })

    form.insertBefore(ul,lateralTitle);


})

</script>


<?php include('./footer.php') ?>
