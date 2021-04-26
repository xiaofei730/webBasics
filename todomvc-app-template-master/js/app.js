// (function (window) {
// 	'use strict';


// 	// Your starting point. Enjoy the ride!

// })(window);



var app = new Vue({
	el: '#app',
	data:{
		title: 'todos',
		todoData:[],
		inp_data:'',
		isSelectAll: false
	},
	//这个方法会在页面渲染之前运行
	mounted: function(){
		this.getAll();
	},

	methods: {
		getAll(){
			axios.get('http://localhost:3000/todoList').then((backdata) => {
			console.log(backdata);
			//对象的结构赋值
			var {data} = backdata;
			//this指向promise,
			//1、直接给this赋值
			//2、改用箭头函数
			//then中是一个普通函数，那么函数中国呢的this指向promise对象
			//then中是一个箭头函数，this将被固定指向Vue实例对象
			this.todoData = data;
			console.log(this.todoData);
			// 变量的结构赋值
			// var {a, b} = {a:1, b:4};
		})
		},
		//添加任务
		addTodoList(ev){
			console.log(ev);
			if(this.inp_data == ''){
				alert('内容不能为空');
			}else{
				var id = this.todoData.length == 0 ? 1 : (this.todoData[this.todoData.length-1].id + 1);
				var content = this.inp_data;
				var data = {id, content, status:false};

				axios({
					method: 'post',
					url: 'http://localhost:3000/todoList',
					data,
				}).then((response) => {
					var {data, status} = response;
					if (status == 200) {
						this.todoData.push(data);
						this.inp_data = '';
					}
				})
				
			}
			
		},

		//事件优于逻辑
		//全选和全不选
		selectAll(){
			var arrcount = this.todoData.length;
			for (let i = 0; i < arrcount; i++) {
				this.todoData[i].status = !this.isSelectAll;
				//数据没处理成功，是因为服务器不行
				axios({
					method: 'put',
					url: 'http://localhost:3000/todoList/' + this.todoData[i].id,
					data: this.todoData[i]
				}).then( (response)=> {
					var {data, status} = response;
				})						
			}
		},

		del(key){
			axios({
				method: 'delete',
				url: 'http://localhost:3000/todoList/' + this.todoData[key].id
			}).then( (response) => {
				var {data, status} = response;
				if (status == 200) {
					this.todoData.splice(key, 1);
				}
				
			})
			
		},

		clearAll(){
			// var newArr = [];
			// for (let i = 0; i < this.todoData.length; i++) {
			// 	if (this.todoData[i].status == false) {
			// 		newArr.push(this.todoData[i]);
			// 	}
				
			// }
			// this.todoData = newArr;
			// filter()方法创建一个新数组，其包含提供函数实现的测试的所有元素
			//task => task.status == false箭头函数    
			//箭头函数 () => {}  如果只有一个参数 a => {} 
			//箭头函数 如果只有一个 return  a => { return 1+ 4}  简写 a => 1+4
			//(task) => { return task.status == false }     
			//function(task){ return task.status == false}
			// this.todoData = this.todoData.filter(task => task.status == false);
			//先获取数组个数，不需要写到循环中，每次都去获取数组个数
			
			// let i = 0
			// while (i < this.todoData.length) {
			// 	if (this.todoData[i].status == true) {
			// 		axios({
			// 			method: 'delete',
			// 			url: 'http://localhost:3000/todoList/' + this.todoData[i].id
			// 		}).then( (response)=> {
			// 			var {data, status} = response;
			// 			if (status == 200) {
			// 				//splice会导致原数组的length发生变化
			// 				this.todoData.splice(i, 1);
			// 			}
			// 		})
			// 	}
			// }
			// var arrCount = this.todoData.length;
			// for (let i = 0; i < arrCount; i++) {
			// 	if (this.todoData[i].status == true) {
			// 		axios({
			// 			method: 'delete',
			// 			url: 'http://localhost:3000/todoList/' + this.todoData[i].id
			// 		}).then( (response)=> {
			// 			var {data, status} = response;
			// 			if (status == 200) {
			// 				//splice会导致原数组的length发生变化
			// 				this.todoData.splice(i, 1);
			// 			}
			// 		})
			// 	}
			// }

			for (let i = 0; i < this.todoData.length; i++) {
				if (this.todoData[i].status == true) {
					axios({
						method: 'delete',
						url: 'http://localhost:3000/todoList/' + this.todoData[i].id
					}).then( (response)=> {
						var {data, status} = response;
						if (status == 200) {
							//splice会导致原数组的length发生变化
							// this.todoData.splice(i, 1);
							this.getAll();
						}
					})
				}
			}
		}
	},
})
