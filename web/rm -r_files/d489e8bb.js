(function(){function t(){self.onmessage=function(){return!0}}try{var n=t.toString(),i=n.substring(n.indexOf("{")+1,n.lastIndexOf("}")),r=new Blob([i],{type:"application/javascript"}),u=URL.createObjectURL(r);typeof BM!="undefined"&&(BM.worker=new Worker(u))}catch(f){}})()