

var tree = function(leafs) {
    var branches = [];      
    if( leafs.length == 1 ) return leafs;       
    for( var k in leafs ) {
        var leaf = leafs[k];
        tree(leafs.join('').replace(leaf,'').split('')).concat("").map(function(subtree) {
            branches.push([leaf].concat(subtree));
        });
    }
    return branches;
};


console.log(tree("12".split('')).map(function(str){return str.join('')})); //[ "12", "1", "21", "2" ]
console.log(tree("abc".split('')).map(function(str){return str.join('')})); //[ "abc", "ab", "acb", "ac", "a", "bac", "ba", "bca", "bc", "b", 5 more… ]




