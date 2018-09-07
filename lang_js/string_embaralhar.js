
function embaralhar_string(str) {
    var a = str.split(""),
        n = a.length;

    for(var i = n - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var tmp = a[i];
        a[i] = a[j];
        a[j] = tmp;
    }
    return a.join("");
}
console.log(embaralhar_string("the quick brown fox jumps over the lazy dog"));
//-> "veolrm  hth  ke opynug tusbxq ocrad ofeizwj"
console.log(embaralhar_string("the quick brown fox jumps over the lazy dog"));
//-> "o dt hutpe u iqrxj  yaenbwoolhsvmkcger ozf "


