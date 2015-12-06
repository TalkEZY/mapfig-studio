<?PHP
class CSV {
	private $header;
	private $defaultProperty;
	private $shapeIds;
	
	public function createCSVFromMapId($id) {
		$this->header = array();
		$this->defaultProperty = "";
		$this->shapeIds = array();
		
		$rows = array();
		
		$points = getShapesByType($id, 'Point');
		$this->createCSVHeader($points);
		array_push($rows, $this->header);
		
		foreach($points as $point) {
			$this->shapeIds[] = $point['id'];
			
			$properties = json_decode($point['properties']);
			$temp = $this->createDummyRow();
			
			$coordinates = str_replace(array("[", "]"), "", $point['coordinates']);
			$coordinates = explode(",", $coordinates);
			
			$longitude = $coordinates[0]; // 2nd last Column
			$latitude  = $coordinates[1]; // last Column
			
			foreach($properties as $property) {
				$index = $this->getHeaderIndexByValue($property->name);
				$temp[$index] = $property->value;
				
				if($property->defaultProperty) {
					$this->defaultProperty = $property->name;
				}
			}
			
			$index = $this->getHeaderIndexByValue("Latitude");
			$temp[$index] = $latitude;
			
			$index = $this->getHeaderIndexByValue("Longitude");
			$temp[$index] = $longitude;
			
			array_push($rows, $temp);
		}
		
		return $rows;
	}
	
	private function createCSVHeader($points) {
		foreach($points as $point) {
			$properties = json_decode($point['properties']);
			
			foreach($properties as $property) {
				if(!in_array($property->name, $this->header)) {
					array_push($this->header, $property->name);
				}
			}
		}
		
		array_push($this->header, "Latitude");
		array_push($this->header, "Longitude");
	}
	
	private function getHeaderIndexByValue($value) {
		if(($index = array_search($value, $this->header)) !== NULL) {
			return $index;
		}
		
		return -1;
	}
	
	private function createDummyRow() {
		$length = count($this->header);
		$dummy = array();
		
		for($i=0;$i<$length; $i++) {
			array_push($dummy, '');
		}
		
		return $dummy;
	}
	
	public function getDefaultProperty() {
		return $this->defaultProperty;
	}
	
	public function getShapeIds() {
		return $this->shapeIds;
	}
}
?>