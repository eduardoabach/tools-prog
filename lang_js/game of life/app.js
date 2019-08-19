
//file:///var/www/html/p/tools/lang_js/game%20of%20life/index.html

var classic_opt = {
	"Clear": [],
	"Glider": [[1,0], [2,1], [2,2], [1,2], [0,2]],
	"Small Exploder": [[0,1], [0,2], [1,0], [1,1], [1,3], [2,1], [2,2]],
	"Exploder": [[0,0], [0,1], [0,2], [0,3], [0,4], [2,0], [2,4], [4,0], [4,1], [4,2], [4,3], [4,4]],
	"10 Cell Row": [[0,0], [1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0], [8,0], [9,0]],
	"Lightweight spaceship": [[0,1], [0,3], [1,0], [2,0], [3,0], [3,3], [4,0], [4,1], [4,2]],
	"Tumbler": [[0,3], [0,4], [0,5], [1,0], [1,1], [1,5], [2,0], [2,1], [2,2], [2,3], [2,4], [4,0], [4,1], [4,2], [4,3], [4,4], [5,0], [5,1], [5,5], [6,3], [6,4], [6,5]],
	"Gosper Glider Gun": [[0,2], [0,3], [1,2], [1,3], [8,3], [8,4], [9,2], [9,4], [10,2], [10,3], [16,4], [16,5], [16,6], [17,4], [18,5], [22,1], [22,2], [23,0], [23,2], [24,0], [24,1], [24,12], [24,13], [25,12], [25,14], [26,12], [34,0], [34,1], [35,0], [35,1], [35,7], [35,8], [35,9], [36,7], [37,8]]
}


var Cell = {
	alive: false,
	neighbor_alive: 0,

	init: function(alive){
		this.alive = alive
	},
	check: function(){
		if(this.neighbor_alive < 2){ //morre de solidão
			this.die();
		} else if(this.neighbor_alive > 3){ //morre por superpopulação
			this.die();
		} else if(this.neighbor_alive == 3 && !this.alive){ //nasce uma nova vida
			this.born();
		}
	},
	born: function(){
		this.alive = true;
	},
	die: function(){
		this.alive = false;
	},
	neighbor_reset: function(){
		this.neighbor_alive = 0;
	},
	neighbor_add_alive: function(){
		this.neighbor_alive += 1
	}
}

var CellCalcAliveFactory = {
	cell_list: {},
	cell: null,
	n_line: null,
	n_column: null,
	n_qtd: null,

	init: function(cell_list){
		this.cell_list = cell_list;
		this.do();
	},
	do: function(){
		for (let n_line in this.cell_list) {
			var line = this.cell_list[n_line];

			for (let n_column in line) {
				var cell_at = this.cell_list[n_line][n_column];

				this.set_check(cell_at, n_line, n_column);
				this.check();
			}
		}
	},
	set_check: function(cell, line, column){
		cell.neighbor_reset();
		this.cell = cell;
		this.n_line = line;
		this.n_column = column;
	},
	check: function(){

		var line = this.n_line
		var line_UP = line-1
		var line_DOWN = line+1

		var column = this.n_column
		var column_L = column-1
		var column_R = column+1
		
		this.check_alive(line_UP, column_L)
		this.check_alive(line_UP, column)
		this.check_alive(line_UP, column_R)

		this.check_alive(line, column_L)
		this.check_alive(line, column_R)

		this.check_alive(line_DOWN, column_L)
		this.check_alive(line_DOWN, column)
		this.check_alive(line_DOWN, column_R)
	},
	check_alive: function(n_line, n_column){
		if(typeof this.cell_list[n_line] === 'undefined')
			return false;
		if(typeof this.cell_list[n_line][n_column] === 'undefined')
			return false;
		if(this.cell_list[n_line][n_column].alive)
			this.add_alive();
	},
	add_alive: function(){
		this.cell.neighbor_add_alive();
	}
}

var GameOfLife = {
	gen: 0,
	gen_limit: 100,
	delay: 0.5, // clock em segudos
	sz: 12,
	cells: {},
	cells_alive_init: [],
	interface: null,

	init: function(el_content, alive_exist){
		this.interface = el_content;

		if(typeof alive_exist !== 'undefined'){
			this.cells_alive_init = alive_exist;
		}
		this.load_cells();
		this.gen_make();
	},
	load_cells: function(){
		//A multiplicacao por -1 vai fazer o grid em tela ter a posição 0,0 como central
		for(var n_line = this.sz * -1; n_line <= this.sz; n_line++){
			this.cells[n_line] = {};

			for(var n_column = this.sz * -1; n_column <= this.sz; n_column++){

				if(this.is_exist_alive_init( n_line, n_column )){
					console.log('ret');
					console.log(n_line);
					console.log(n_column);
					console.log(this.is_exist_alive_init( n_line, n_column ));
				}

				var c = Object.create(Cell);
				c.init( this.is_exist_alive_init( n_line, n_column ) );
				this.cells[n_line][n_column] = c;
			}
		}

		console.log('end');
		console.log(this.cells);


	},
	is_exist_alive_init: function(n_line, n_column){
		var result = false;
		this.cells_alive_init.forEach(function(cell_vector){
			if(result === false && cell_vector[0] == n_line && cell_vector[1] == n_column)
				result = true;
		});
		return result;
	},
	gen_make: function(){
		var self = this;
		this.gen += 1;
		// this.gen_check_rules();
		this.interface_render();

		if(this.gen < this.gen_limit){
			console.log(this.cells);
			// setTimeout(function(){
			// 	self.gen_make();
			// }, this.delay * 1000);
		}
	},	
	gen_check_rules: function(){
		var CFact = Object.create(CellCalcAliveFactory);
		CFact.init(this.cells);

		for (let n_line in this.cells) {  
			var line = this.cells[n_line];

			for (let n_column in line) {
				var cell = line[n_column];
				cell.check();
			}
		}
	},
	interface_render: function(){
		var self = this;
		var view = 'Generation: ' + this.gen.toString() + self.interface_break_line();

		for (let n_line in this.cells) {  
			var line = this.cells[n_line];
			view += ' line: '+n_line;
			view += self.interface_break_line()

			for (let n_column in line) {
				var cell = line[n_column];
				view += (cell.alive) ? '[X]' : '[ ]'
			}
		}

		this.interface.innerHTML = view;
		// TODO
		// os.system('clear')
		// print(view)
	},
	interface_break_line: function(){
		return '<br>';
	}
}