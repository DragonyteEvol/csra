// -----------------------------------DANGERRRRRRRR--------------------------------------------------------------------------------------------------------
// Cifrar por blob el acceso a este archivo
// -----------------------------------------------------------------------------------------------------------------------------------------------------
// crea los eventos necesarios para una busqueda y sus consecuencias
// recibe como parametro de entra un json con la configuracion de la busqueda

// componenetEvent = El componente que recibira los eventos de cambio y keyup
// listOptions = la lista de opciones que se modificara cuando el servidor arroge respuesta
// searh = el nombre del modelo sin "controller" sobre el cual se realizara la busqueda
// componnets = el arreglo de componenetes que se quiere modificar cuando el evento arroje respuesta
// value = el valor que se quiere representar en la opcion de listOptions
// EJEMPLO
// ({
// componentEvent: "template",
// 	listOptions: "datalistOptions",
// 	search: "template",
// 	components: new Map([
// 		["source_id","plugin_id"],
// 		["source","vendor"],
// 		["event_id","sid"]
// 	]),
// 	value: "name",
// 	table: "plugin_sid"
// })
function searchEvent(args){
	// Tomar los elementos pricipales de la busqueda
	var componentEvent = document.getElementById(args.componentEvent)
	var options = document.getElementById(args.listOptions)
	if(componentEvent==null){
		axios_get(args,options)
	}else{
		// evento de keyup y axios
		componentEvent.addEventListener('keyup',(e) =>{
			search = componentEvent.value;
			axios_get(args,options,search)
		})
		//evento de cambio
		componentEvent.addEventListener("change", (e)=>{
			for(var option of options.childNodes){
				if(option.value==componentEvent.value){
					for(c of args.components.keys()){
						var com = document.getElementById(c)
						com.value = option.attributes[c].value
					}
				}
			}

		})
	}
}

function axios_get(args,options,search=""){
	axios({
		method: "GET",
		url: "/"+args.search+"/search/" + (search.replace(" ","_"))
	}).then(res =>{
		console.log(res.data)
		options.innerHTML = ""
		select_options = ""
		for(var p of res.data[args.table]){
			select_options += "<"+args.tag+" "
			for(var pa of args.components){
				var val = pa[1]
				select_options += pa[0] + "='"+p[val]+"' "
			}
			var internalValue = args.value
			select_options += "value='"+p[internalValue]+"' class='"+args.class+"' onclick='"+args.customFunction+"({"
			for(var pa of args.components){
				var val = pa[1]
				select_options += pa[0] + ": "+ '"'+p[val]+'",'
			}
			select_options += "})'>"+p[internalValue]+"</"+args.tag+">"
		}
		options.innerHTML = select_options
	}).catch(e => {
		console.log("DEBUG:" + e)
	})
}

//-------------------------------------------------------------------------------
//Busca de forma asincrona en una tabla de base de datos para representarl la informacion consultada en una tabla
//resibe como entrada un argumento de tipo json de la siguiente forma:
//
/*{
componentevent: "search",
	listoptions: "kris",
	search: "kri",
	components: [
		"objective",
		"propertie",
		"percentage"
	],
	value: "kri",
	table: "kris",
}*/
//donde componentEvent es el cuadro de texto sobre el cual se realiza la busqueda
//listOptions es el cuerpo del elemento sobre el cual se van a mostrar los datos
//componenets es un array lista o elemeto iterable que contiene todos los datos a representar en la fila de informacion
//value es el campo principal del registro que generalmente es el nombre y que tiene un link asociado a el
//tabla es la tabla en base de datos sobre la cual se realizara la consulta
function searchTable(args){
	// Tomar los elementos pricipales de la busqueda
	var componentEvent = document.getElementById(args.componentEvent)
	if(args.date){
		var from = document.getElementById(args.date.from)
		var to = document.getElementById(args.date.to)
	}
	var options = document.getElementById(args.listOptions)
	// evento de keyup y axios
	componentEvent.addEventListener('keyup',(e) =>{
		search = componentEvent.value;
		if(args.date){
			var uri =  "/"+args.search+"/search/" + (search.replace(" ","_")) +"/"+ formatDate(from.value) +"/"+ formatDate(to.value)
		}else{
			var uri = "/"+args.search+"/search/"  + (search.replace(" ","_")) +"//"
		}
		console.log(uri)
		axios({
			method: "GET",
			url: uri
		}).then(res =>{
			var html = ""
			for(var p of res.data[args.table]){
				html+="<tr><th scope='row'>"+p.master_id+"</th>"
				html+="<td><a href='/"+args.value+"/show/"+p.master_id+"'>"+p[args.value]+"</a></td>"
				for(o of args.components){
					if(o=="score"){
						html+="<td><span class='badge text-bg-primary'>"+p[o]+"</span></td>"
					}else{
						html+="<td>"+p[o]+"</td>"
					}
				}
				html+="</tr>"
				options.innerHTML=html
			}
		}).catch(e => {
			console.log("DEBUG:" + e)
		})
	})
}

function redirect(controller,id,from,to){
	var Ifrom = document.getElementById(from)
	var Ito = document.getElementById(to)
	from = formatDate(Ifrom.value)
	to = formatDate(Ito.value)
	console.log('/' + controller + "/show/" + id + "/" + from + "/" + to)
	location.href ='/' + controller + "/show/" + id + "/" + from + "/" + to;	
}

function formatDate(datef){
	if(datef.trim().length === 0){
		return '';
	}
	var date = new Date(datef);
	date.setDate(date.getDate() + 1)
	var getYear = date.toLocaleString("default", { year: "numeric" });
	var getMonth = date.toLocaleString("default", { month: "2-digit" });
	var getDay = date.toLocaleString("default", { day: "2-digit" });
	var dateFormat = getYear + getMonth + (getDay);
	return dateFormat
}
