<?='<?'?>

# WARNING !!!
# This class has been generated by Oxygen.
# Any changes here will be overwritten on the next genertion.

<?$m = $this->model?>
class <?=$m['className']['model']?>_ extends <?=$this->parent->model['model']?> {

    private static $data_set = null;
    private static $data_source = null;

<?foreach ($this as $field):?>
    public static $field_<?=$field->model->name?> = null;
<?endforeach?>

    private static $fields = array();
    public static function __getFields() {
        return self::$fields;
    }

    public function __getPattern() {
        return '<?=$m['pattern']?>';
    }

    public static function all() {
        return self::$data_source;
    }

    public static function __class_construct($scope) {

        self::$data_set = $scope->connection['<?=$m['source']?>'];
        self::$data_set->scope->register('Row','<?=$m['className']['model']?>');
        self::$data_source = self::$data_set->getData('_');
<?foreach ($this as $field):?>    
        self::$fields['<?=$field->model->name?>'] = self::$field_<?=$field->model->name?> = $scope-><?$field->model->put_new()?>;
<?endforeach?>        
    }

<?foreach ($this as $field):?>
<?$field->model->put_code()?>
<?endforeach?>


}

<?='?>'?>