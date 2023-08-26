<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?=siteTitleTodo?></title>
  <link rel="stylesheet" href=<?=baseUrl."assets/css/style.css"?>>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
      <a href="<?=siteUrl("auth.php")?>" style = "text-decoration:none"><i class="fa fa-sign-out"></i></a><span class="username"><?= getLoggedInData()->fullName ?? null?></span></div>
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
        <li class = "<?= (isset($_GET['folderId']) &&( $_GET['folderId']))?'':'active'; ?>">
        <a href="<?=baseUrl?>"><i class="fa fa-folder"></i>All</a>
          
        </li>
          

          <?php foreach ($folders as $folder): ?>
          <li class="<?=isset($_GET['folderId']) && ($_GET['folderId']==$folder->id) ? 'active' : '' ;?>">
          <a href="?folderId=<?=$folder->id?>"><i class="fa fa-folder"></i><?=$folder->name?></a>
          <a href="?folderDeleteId=<?=$folder->id?>" class="remove"  onclick="return confirm('Are You Sure to delete this Item?\n<?=$folder->name?>');">x</a>
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
            <li data-taskId="<?=$task->id?>"    class=" isDone clickable <?=$task->isDone? 'checked': '' ; ?>">
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
  <script>
    $(document).ready(function(){
      $('.isDone').click(function(){
        var taskIdInput = $(this).attr('data-taskId');
        $.ajax({
          url : 'process/ajaxHandler.php',
          method : 'POST',
          data : 
          {
            action : 'doneSwitch',
            taskId : taskIdInput

          },
          success : function(response){
            location.reload();
          }



        });
      });
      var inputFolder = $('input#addFolderInput');
      $('#addFolderBtn').click(function(){

        $.ajax({

          url : 'process/ajaxHandler.php',
          method : 'POST',
          data :
          {

            action : 'addFolder',
            folderName : inputFolder.val()
          },

          success : function(response){
            if(response == '1'){

              $('<li><a href="?folderId=#"><i class = "fa fa-folder"></i>'+inputFolder.val()+'</a></li>').appendTo('ul.folderList');
            }else{

              alert(response);
            }
          }


        });



      });
      $(document).on('keypress',function(event) {

        var inputTask= $('input#addTaskInput');
        if(event.which == 13) {
          $.ajax({
            url : 'process/ajaxHandler.php',
            method : 'POST',
            data :
            {
              action : 'addTask',
              folderId : <?=$_GET['folderId'] ?? 0 ?>,
              taskTitle :  inputTask.val()


            },
            success : function(response){
              location.reload();
            }



          });
        }
      });



      $("input#addTaskInput").focus();

    });
</script>

</body>
</html>
