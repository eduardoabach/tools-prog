var games = new Array();
var pages = new Array();
var tips = new Array();

function populateGameData()
{
  var i=0;

  games[i] = "My Projects";
  pages[i] = "about/index.html";
  tips[i]  = "My Sites/Projects"

  i++;
  games[i] = "JS Games Home";
  pages[i] = "index.html";
  tips[i]  = "Go to the Home Page!"

  i++;
  games[i] = "Download Games";
  pages[i] = "download.html";
  tips[i]  = "Download the games to your PC"

  i++;
  games[i] = "Marbles";
  pages[i] = "marbles.html";
  tips[i]  = "Get all the marbles off the board!\nThe latest craze!"

  i++;
  games[i] = "Place It";
  pages[i] = "placeit.html";
  tips[i]  = "Arrange a bunch of crazy coloured pieces!\nYou'll like it!"

  i++;
  games[i] = "Jigsaw Puzzle";
  pages[i] = "jigsaw.html";
  tips[i]  = "Play a Picture Puzzle with any picture! \nWarning: A very addictive game!"

  i++;
  games[i] = "Arrange";
  pages[i] = "arrange.html";
  tips[i]  = "Arrange the numbers in order. \nHmmm... Challenging game!";

  i++;
  games[i] = "Tic-Tac-Toe";
  pages[i] = "tictactoe.html";
  tips[i]  = "Play the age-old game of Tic-Tac-Toe. \nGet 'em straight!";

  i++;
  games[i] = "Hi-Lo";
  pages[i] = "hilo.html";
  tips[i]  = "A simple number guessing game. \nCool your heads!";
}

function getGamesListCode(currgame)
{
  var target;

  populateGameData();

  var code = "";
  for (i=0; i<games.length;i++)
  {
    if (i == 3)
      code += '<span class=clsBar>' + '&nbsp;<br>&nbsp;' + '</span>';
    else if (i != 0)
      code += '<span class=clsBar>' + ' &#149; ' + '</span>';

    if (games[i] == currgame)
    {
      code += '<span class=clsThisGame title="' +
              tips[i] + '">' + games[i] + '</span>';
    }
    else
    {
      if (i == 0)
        target = " target=_blank";
      else
        target = "";

      code += '<a class=clsOtherGame href="' + pages[i] +
              '"' + target + ' title="' + tips[i] + '">' + games[i] + '</a>';
    }
  }
  return code;
}

function getGameDownloadCode()
{

  var code = "";
  var d = "http://prdownloads.sourceforge.net/jsgames/";
  var tar = ".tar.gz?download";
  var zip = ".zip?download";

  code += '<table border=0 style="border:1px solid #990000;">'
  code += '<tr><th>&nbsp;</th>';
  code += '<th>Windows ZIP</th>';
  code += '<th>Unix TAR/GZIP</th>';
  code += "</tr>";

  for (i=3; i<games.length; i++)
  {
    currgame = pages[i].replace(".html","");

    code += '<tr><td class=clsDownload>' + games[i] + '</td>';
    code += '<td><a target=_blank class=clsOtherGame href="' + d + currgame + zip + '">' + currgame 
            + '.zip</a></td>';
    code += '<td><a target=_blank class=clsOtherGame href="' + d + currgame + tar + '">' + currgame 
            + '.tar.gz</a></td>';
    code += "</tr>";
  }
  code += "</table>";

  return code;
}
