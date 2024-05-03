  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" type="tex/css">
    <title>Document</title>
    <style>
<?php require_once "../resources/css/style.css" ?>
    </style>
</head>
<body>
        <form class="form-container" id="taskInfo" action="" method="">
        <label for="title" >Title</label>
        <input type="text" id="title" name="title" require >
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" >
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="5"></textarea>
        <button class="form-btn" type="submit">Send</button>
        </form>
        <div class="task-container" id="tasks-container">
      
    <button class="task-btn generate-pdf">Generate PDF for All Tasks</button>
    </div>
    
</body>
<script>
    <?php require_once("../resources/js/index.js");?>
</script>
</html>



<!-- data-task-id="'id' "-->