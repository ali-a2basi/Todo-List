<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?=siteTitle?></title>
  <link rel="stylesheet" href=<?=baseUrl."assets/css/style.css"?>>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">User1</span></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folderList">
        <li class="<?=isset($_GET['folderId'])?'':'active';?>" >
          <i class="fa fa-folder"></i>All</a>

          <?php foreach ($folders as $folder): ?>
          <li class = "<?php $result = ($_GET['folderId']==$folder->id)?'active':'';
          echo $result;?>">
          
          <a href="?folderId=<?=$folder->id?>"><i class="fa fa-folder"></i><?=$folder->name?></a>
          <a href="?delete_folder=<?=$folder->id?>" class="remove"  onclick="return confirm('Are You Sure to delete this Item?\n<?=$folder->name?>');">x</a>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
    <div>
      <input type="text"   placeholder="Add New Folder..." id="addFolderInput"   style='width: 65%;margin-left:3%'>
      <button type="button" class="btn clickable" id="addFolderBtn">+</button>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        
        <div class="title" style="width: 55%;">
        <input type="text"   placeholder="Add New Task..." id="addTaskInput"   style='width:100%;line-height:30px;'>
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <?php if(sizeof($tasks)):?>
            <?php foreach($tasks as $task):?>
              <!-- $result = condition ? value1 : value2;   ternary operator php-> one line if statement -->
            <li class="<?=$task->isDone? 'checked': '' ; ?>">
              <i class="<?= $task->isDone? 'fa fa-check-square-o' : 'fa fa-square-o' ;  ?>"></i>
              <span><?=$task->title?></span>
              <div class="info">
                <span class="dateCreatedAt">Date Created: <?=$task->createdAt?></span>
                <a href="?taskDeletedId= <?= $task->id ?>" onclick="return confirm('Are your sure to delete <?=$task->title?> ?');" ><i class="fa fa-trash-o" style="color:red;"></i></a>
            </div>
            </li>
            <?php endforeach?>
            <?php else:?>
              <li>No Task Here ....</li>
            <?php endif;?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script  src="assets/js/script.js"></script>
  <script>

    $(document).ready(function(){
      $('#addFolderBtn').click(function(){
        var inputFolder = $('input#addFolderInput');

        $.ajax({

          url : 'process/ajaxHandler.php',
          method : "POST",
          data : 
          {
            action : "addFolders",
            folderName : inputFolder.val()

          },
          success : function(response){
            if(response = "1"){
//adding folder id
              $('<li> <a href="?folderId=<?=(int)end($folders)->id+1 ?>"><i class="fa fa-folder"></i>' +
                            inputFolder.val() +
                            '</a></li>').appendTo('ul.folderList');
                            


            }else{
              alert(response);
            }
            
          },
        });
      });


      $(document).on('keypress',function(e) {
          if(e.which == 13) {
            var inputTask = $('input#addTaskInput');
            $.ajax({
              url : 'process/ajaxHandler.php',
              method : 'POST',
              data : 
              {
                action : 'addTask',
                taskTitle : inputTask.val()

              },
              success : function(response){



              }



            });
          }
      });
    });


  </script>
</body>
</html>
