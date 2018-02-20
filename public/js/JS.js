//Variables
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

//Attributes
$(".list-name").click(function()
{
	$(this).replaceWith(`<div class='change-name'><input type='text'><button class='comf-btn' onclick='comfBtn($(this))'>comfirm</button></div>`)
})


$(".item-item").click(function()
{
		let id = $(this).parent().parent().attr('id')
		$.post(`newTask/${id}`)
		let task_id = getTaskId($(this))
	$(this).parent().parent().prepend(`<li id='task${task_id}'><p class='item-name'>New task</p><span class='del' id="del{{$task[0]}}">delete</span></li>`)
	$(".item-name").click(function()
	{	let value = $(this).html()
		$(this).replaceWith(`<textarea>${value}</textarea><button onclick='taskBtn($(this))'>confirm</button>`)
	})
})


$(".item-name").click(function()
{	let value = $(this).html()
	$(this).replaceWith(`<textarea>${value}</textarea><button onclick='taskBtn($(this))'>confirm</button>`)
})


$("#list-add").click(function()
{	
	$.post(`newList`).done(function(data){
		$("#list-list").prepend(`<p class='list-name'id = 'name${data.last_inserted_id}'>New List</p><span class='delete' id="delete{{$list->id}}><i class='fa fa-trash' "></i></span><ul class='list-item' id = '${data.last_inserted_id}'><li id='task1'><p class='item-name'>New task</p><span class='del' id="del{{$task[0]}}">delete</span></li><li><p class='item-item'>+add task</p></li></ul>`)
		$(".list-name").click(function()
		{
			$(this).replaceWith(`<div class='change-name'><input type='text'><button class='comf-btn' onclick='comfBtn($(this))'>comfirm</button></div>`)
		})
	})

	$(".item-item").click(function()
	{
			let id = $(this).parent().parent().attr('id')
			$.post(`newTask/${id}`)
			let task_id = getTaskId($(this))
		$(this).parent().parent().prepend(`<li id='task${task_id}'><p class='item-name'>New task</p><span class='del' id="del{{$task[0]}}">delete</span></li>`)
		$(".item-name").click(function()
		{	let value = $(this).html()
			$(this).replaceWith(`<textarea>${value}</textarea><button onclick='taskBtn($(this))'>comfirm</button>`)
		})
	})
})


$('.delete').click(function()
{
	let id = $(this).attr('id')
	id = id.substr(6)
	$.post(`deleteList/${id}`)
	$(this).prev().remove()
	$(this).next().remove()
	$(this).remove()
})

$('.del').click(function()
{
	let id = $(this).attr('id')
	id = id.substr(3)
	let par_id = $(this).parent().parent().attr('id')
	console.log(id)
	
	$.post(`deleteTask/${par_id}`, {id:id}).done(function(data){console.log(data)})
	$(this).parent().remove()
})

//Functions
function comfBtn(value)
{
	let sib = value.prev().val()
	let id = value.parent().next().attr('id')
	value.parent().replaceWith(`<li><p class='list-name' id = 'name${id}'>`+sib+`</p></li>`)
	
	$.post(`listChange/${id}`,{name:'name', value:sib })
	$(".list-name").click(function()
	{
		$(this).replaceWith("<div class='change-name'><input type='text'><button class='comf-btn' onclick='comfBtn($(this))'>comfirm</button></div>")
	})
}

function taskBtn(value)
{
	let sib = value.prev().val()
	let id = value.parent().parent().attr('id')
	let task_id = getTaskId(value)
	$.post(`taskChange/${id}`,{name:'task', value:sib, id: task_id}).done(function(data){console.log(data)})
	value.parent().replaceWith(`<li id='task${task_id}'><p class='item-name' >`+sib+`</p><span class='del' id="del{{$task[0]}}">delete</span></li>`)
		$(".item-name").click(function()
	{	let value =$(this).html()
		$(this).replaceWith(`<textarea>${value}</textarea><button onclick='taskBtn($(this))'>comfirm</button>`)
	})
}
function getTaskId(value){
	
	if(value.parent().is(':first-child')){
		var task_id = 1

	}else
	{
		var	task_id = value.parent().prev().attr('id')
		task_id = task_id.slice(-1)
		task_id ++
	}
	console.log(task_id)
	return task_id
}