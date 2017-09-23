fs = require("fs");
http = require("http");
url = require("url");
path = require("path");
util = require("util");
		
		
function parse_query_variables(url) {
	var filename_params = url.split("?")
	if (filename_params.length != 2)
		return [];
	var query = filename_params[1];
	var vars = query.split("&");
	var ret = {};
	for (var i=0; i<vars.length; i++) {
		if (vars[i].length == 0) // prevent ?&var=bla
			continue;
		var pair = vars[i].split("=");
		key = unescape(pair[0]);
		value = unescape(pair[1]);
		ret[key] = value;
	}
	return ret;
}		

http.createServer(function (req, res) {
	//console.log(req);
	{
		$_GET = parse_query_variables(decodeURI(req.url));
		
		
		
		//res.header();
		//res.writeHead(200, { "Content-Type": "text/html" });
		
		if (0) {
			html = util.inspect($_GET);
			//res.end('<video src="movie.mp4" controls></video>');
			res.end("<pre>" + html + "</pre>");
			return;
		}
		
		if ($_GET["file"] == undefined) {
			res.writeHead(200, { "Content-Type": "text/html", 'Access-Control-Allow-Origin': '*' });
			res.end('no filename');
			return;
		}
		//var file = path.resolve(__dirname, $_GET["file"]);
		//console.log("file: ", file);
		
		//res.writeHead(200, { "Content-Type": "text/html" });
		//res.end($_GET["file"]);
		//return;
		
		file = $_GET["file"];
		fs.stat(file, function(err, stats) {
			if (err) {
				if (err.code === 'ENOENT') {
					// 404 Error if file not found
					return res.sendStatus(404);
				}
				res.end(err);
			}
			var range = req.headers.range;
			
			var start = 0;
			var total = stats.size;
			var end = total - 1;
			
			if (!range) {
			 // 416 Wrong range
			 
				//res.writeHead(200, { "Content-Type": "text/html" });
				//res.end('missing range');
				//return;
			 //return res.sendStatus(416);
				//return;
			} else {
				var positions = range.replace(/bytes=/, "").split("-");
				//console.log("positions", positions, "positions[0]", positions[0], "positions[1]", positions[1])
				
				range = req.headers.range; // e.g. "bytes=0-".split("=")    result = ["bytes", "0-"]
				parts = range.split("=")
				// parts[0] is "bytes"
				// parts[1] is "0-"
				positions = parts[1].split("-")
				// positions[0] is "0"
				// positions[1] is ""
				
				start = parseInt(positions[0]);
				if (positions[1] == "") {
					end = total - 1;
				} else {
					end = parseInt(positions[1]);
				}
				
			}
			
			//end = 1024*1024*100;
			
			//var chunksize = 1024*1024*100;
			var chunksize = (end - start) + 1;
			
			
			// poor hack to send smaller chunks to the browser
			var maxChunk = 1024 * 1024 * 100; // 1MB at a time
			if (chunksize > maxChunk) {
				end = start + maxChunk - 1;
				chunksize = (end - start) + 1;
			}			
			
			
			console.log("start", start/1024/1024, "end", end/1024/1024, "total", total/1024/1024, "chunksize", chunksize/1024/1024);
			
			res.writeHead(206, {
				"Content-Range": "bytes " + start + "-" + end + "/" + total,
				"Accept-Ranges": "bytes",
				"Content-Length": chunksize,
				"Content-Type": "video/mp4",
				//'Access-Control-Allow-Origin': 'http://localhost',
				'Access-Control-Allow-Origin': '*',
				'Access-Control-Allow-Methods': 'POST, GET, OPTIONS'
			});

			var stream = fs.createReadStream(file, { start: start, end: end })
				.on("open", function() {
					stream.pipe(res);
				}).on("error", function(err) {
					res.end(err);
				});
		});
	}
}).listen(8888);
//}).listen(8888, "0.0.0.0");