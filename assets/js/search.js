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
			console.log(select_options)
		}
		options.innerHTML = select_options
	}).catch(e => {
		console.log("DEBUG:" + e)
	})
}
