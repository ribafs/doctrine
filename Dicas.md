# Dicas sobre Doctrine

## Uso no terminal para ter argumento opcional
```
$theDefaultEngineerId = (isset($argv[2])) ? $argv[2] : 1;
$productIds = explode(",", $argv[3]);
```

## Método com datetime

public function setCreated(\DateTime $created)


