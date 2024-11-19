var UP = 0;
var DOWN = 1;
var LEFT = 2;
var RIGHT = 3;

var foodLife = 0;
var foodTime = 1;
var foodHome = 2;
var foodBomb = 3;
var foodStar = 4;
var foodGod = 5;
var foodNon = 6;

var offerX = 32;
var offerY = 16;

var NON = 0;
var WALL = 1;
var GRID = 2;
var GRASS = 3;
var WATER = 4;
var ICE = 5;
var HOME = 9;
var DIE = 10;


var STATE_INIT = 1; 
var STATE_PLAY = 2;
var STATE_STAGE_INIT = 3;  
var STATE_GAMEOVER = 4; 
var STATE_SELECT = 5; 
var STATE_GAMESTART = 6; 


var K_UP = 38;
var K_DOWN = 40;
var K_RIGHT = 39;
var K_LEFT = 37;

var K_SPACE = 32;
var K_TAB = 9;
var K_ENTER = 13;
var K_CTRL = 17;
var K_ALT = 18;

var K_0 = 48;
var K_1 = 49;
var K_2 = 50;
var K_3 = 51;
var K_4 = 52;
var K_5 = 53;
var K_6 = 54;
var K_7 = 55;
var K_8 = 56;
var K_9 = 57;
var K_A = 65;
var K_B = 66;
var K_C = 67;
var K_D = 68;
var K_E = 69;
var K_F = 70;
var K_G = 71;
var K_H = 72;
var K_I = 73;
var K_J = 74;
var K_K = 75;
var K_L = 76;
var K_M = 77;
var K_N = 78;
var K_O = 79;
var K_P = 80;
var K_Q = 81;
var K_R = 82;
var K_S = 83;
var K_T = 84;
var K_U = 85;
var K_V = 86;
var K_W = 87;
var K_X = 88;
var K_Y = 89;
var K_Z = 90;

var images = new Array();

images["home"] = [256,0];
images["map"] = [0,96];
images["tankNum"] = [0,112];
images["myTank"] = [0,0];
images["myTank2"] = [128,0];
images["tank1"] = [0,32];
images["tank2"] = [128,32];
images["tank3"] = [0,64];
images["tankRun"] = [128,96];
images["hitFx"] = [320,0];
images["bombFx"] = [0,160];
images["bullet"] = [80,96];
images["tankStart"] = [256,32];
images["food"] = [256,110];
images["score"] = [192,96];
images["num"] = [256,96];
images["shield"] = [160,96];
images["stageStart"] = [396,96];
images["gameOver"] = [384,64];

var imgStartData = "img/download.gif";
var imgStart = new Image();
imgStart.src = imgStartData;


function GameStart()
{
	this.x = 0;
	this.y = 512;	
}


GameStart.prototype.draw = function()
{
	var myCanvas = document.getElementById("upp");
	var graphics = myCanvas.getContext("2d");
	if(this.y == 512)
	{
		graphics.fillStyle = "#000";
		graphics.fillRect(0, 0, 512, 448);
	}
	graphics.drawImage(imgStart, this.x, this.y, 512, 448);
	
	if(this.y <= 0) 
	{
		this.y = 0;
		graphics.drawImage(imgStart, this.x, this.y, 512, 448);

		gameState = STATE_SELECT;
		this.init();

	}
	
	this.y -= 5;
}

GameStart.prototype.init = function()
{
	this.y = 512;
}



function TankRun()
{
	this.x = 128;
	this.time = 0;
	
	this.num = 0;
	this.ys = [248, 280, 312];
}

TankRun.prototype.draw = function()
{
	var myCanvas = document.getElementById("stage");
	var graphics = myCanvas.getContext("2d");
	var img = document.getElementById("tankAll");
	
	this.time ++;
	var temp;
	
	if( parseInt(this.time / 6) % 2 == 0)
	{
		temp = 0;
	}
	else
	{
		temp = 27;
	}
	graphics.drawImage(img, images["tankRun"][0],images["tankRun"][1] + temp, 27,27, this.x, this.ys[this.num], 27, 27 )
}

TankRun.prototype.init = function()
{
	
	var myCanvas = document.getElementById("stage");
	var graphics = myCanvas.getContext("2d");
	graphics.clearRect(this.x, this.ys[this.num], 27, 27);
	
	this.time = 0;
	this.num = 0;
}

TankRun.prototype.next = function(n)
{
	var myCanvas = document.getElementById("stage");
	var graphics = myCanvas.getContext("2d");
	
	graphics.clearRect(this.x, this.ys[this.num], 27, 27);
	
	if(n == 1) 
	{
		if(this.num == 2) 
		{
			this.num = 0;
			return;
		}
		this.num ++;
	}
	else 
	{
		if(this.num == 0) 
		{
			this.num = 2;
			return;
		}
		this.num --;
	}
}



function GameOver()
{
	this.x = 210;
	this.y = 512;	
}


GameOver.prototype.draw = function()
{
	var myCanvas = document.getElementById("stage");
	var graphics = myCanvas.getContext("2d");
	var img = document.getElementById("tankAll");
	
	graphics.clearRect(this.x, this.y + 2, 62, 30);
	graphics.drawImage(img, images["gameOver"][0],images["gameOver"][1], 62, 30, this.x, this.y, 62, 30);
	
	if(this.y <= 100) 
	{
		gameState = STATE_GAMESTART;
		graphics.clearRect(this.x, this.y, 62, 30);
		this.init();
	}
	
	this.y -= 2;
}

GameOver.prototype.init = function()
{
	this.y = 512;
}



