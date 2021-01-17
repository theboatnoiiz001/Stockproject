var data = '0630638151';
data = data.split(" ").join("")
data = data.split("-").join("")
console.log(data)
indexData = 0
arrayindex = []
for(j=0;j<data.length;j++){if(data[j]=='0'){arrayindex.push(j)}}
console.log(arrayindex)
for(b=0;b<arrayindex.length;b++){
	phone = data.substring(arrayindex[b],arrayindex[b]+10);
	if(Number(phone)){
		if(phone.length == 10){
			console.log(phone)
		}
	}
}
