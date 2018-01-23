
function sha_cript(str, mode){
	if(mode == undefined)
		mode = "SHA-256";
	var buffer = new TextEncoder("utf-8").encode(str);
	return crypto.subtle.digest(mode, buffer).then(function (hash) {
		return hex(hash);
	});
}

function hex(buffer){
  var hexCodes = [];
  var view = new DataView(buffer);
  for (var i = 0; i < view.byteLength; i += 4) {
    // Using getUint32 reduces the number of iterations needed (we process 4 bytes each time)
    var value = view.getUint32(i)
    // toString(16) will give the hex representation of the number without padding
    var stringValue = value.toString(16)
    // We use concatenation and slice for padding
    var padding = '00000000'
    var paddedValue = (padding + stringValue).slice(-padding.length)
    hexCodes.push(paddedValue);
  }

  // Join all the hex strings into one
  return hexCodes.join("");
}

//SHA-256, default
sha_cript("foobar").then(function(digest) {
  console.log(digest);
}); // outputs "c3ab8ff13720e8ad9047dd39466b3c8974e592c2fa383d4a3960714caef0c4f2"

sha_cript("foobar", "SHA-1").then(function(digest) {
  console.log(digest);
}); // outputs "8843d7f92416211de9ebb963ff4ce28125932878"

sha_cript("foobar", "SHA-384").then(function(digest) {
  console.log(digest);
}); // outputs "3c9c30d9f665e74d515c842960d4a451c83a0125fd3de7392d7b37231af10c72ea58aedfcdf89a5765bf902af93ecf06"

sha_cript("foobar", "SHA-512").then(function(digest) {
  console.log(digest);
}); // outputs "0a50261ebd1a390fed2bf326f2673c145582a6342d523204973d0219337f81616a8069b012587cf5635f6925f1b56c360230c19b273500ee013e030601bf2425"
