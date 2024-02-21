<?php 
class TemplateModel extends Model{

	/* tabla en la que actua  este modelo en base de datos */
	protected $table = "plugin_sid";

	/* columns que modifica el modelo en base de datos */
	protected $columns = ["name"];

	/* columnas para modificacion en base de datos con consulta preparada */
	protected $args= [":name"];

	public function __construct(){
		parent::__construct(TRUE);
	}

	/* busca un evento en el servidor osim para relacionar el id del servidor anfitrion con el id asignado en osiem */ 
	/* recibe un string con el nombre del evento a buscar */
	/* retorna un string con las coincidencias mas cercanas a la busqueda propuesta con un maximo de 10 para optimizar*/
	public function search($search)
	{
		$sql = "SELECT $this->table.name,plugin_id,sid,vendor from $this->table inner join plugin on plugin.id=plugin_sid.plugin_id where $this->table.name like '%$search%' limit 10";
		$this->getCustom($sql);
		return ($this->data);
	}

}
?>
