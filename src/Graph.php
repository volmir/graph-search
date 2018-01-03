<?php

namespace App;

/**
 * 
 * @link https://prog-cpp.ru/data-graph/ 
 */

class Graph {

    const NODE_NOT_FINDED = 0;
    const NODE_NOT_VISITED = 1;
    const NODE_VISITED = 2;

    /**
     *
     * @var Logger
     */
    private $logger;
    
    /**
     *
     * @var Printer
     */
    private $printer;
    
    /**
     *
     * @var array
     */
    private $data = [];

    /**
     *
     * @var int
     */
    private $end;

    /**
     *
     * @var int
     */
    private $next;

    /**
     *
     * @var \SplQueue 
     */
    private $Queue;

    /**
     *
     * @var \SplStack 
     */
    private $Stack;    
    
    /**
     *
     * @var \SplStack
     */
    private $trajectory;
    /**
     *
     * @var array 
     */
    private $nodes = [];


    public function __construct() {
        $this->logger = new Logger();
        $this->printer = new Printer();
    }

    private function init() {
        $this->__construct();
        
        $this->Stack = new \SplStack();
        $this->Queue = new \SplQueue();
        $this->trajectory = new \SplStack();
        $this->next = '';

        $this->nodes = [];
        for ($i = 0; $i < count($this->data); $i++) {
            $this->nodes[] = self::NODE_NOT_FINDED;
        }
    }
    
    /**
     * 
     * @param array $data
     */
    public function setData(array $data = []) {
        $this->data = $data;
    }    
    
    /**
     * 
     * @param int $end
     */
    public function setDestination(int $end) {
        $this->end = $end;
        if ($this->end > 0) {
            $this->end--;
        }
        
        $this->logger->add('');
        $this->logger->add('Требуется найти путь от вершины 1 к ' . ($this->end + 1));
        $this->logger->add('');
        $this->printer->set($this->logger->getMessages())->show();
    }    
    
    public function setDestinationConsole() {
        $this->logger->add('Введите вершину, к которой надо придти: ');
        $this->end = intval(fgets(STDIN));
        if ($this->end > 0) {
            $this->end--;
        }
        
        $this->logger->add('');
    }

    public function searchBreadth() {
        $this->init();

        $this->logger->add('------------------------------');
        $this->logger->add('');
        $this->logger->add('Поиск по графу в ширину');        
        
        $this->Queue->enqueue(0);
        while (!$this->Queue->isEmpty()) {
            $node = $this->Queue->dequeue();

            if (isset($this->nodes[$node]) && $this->nodes[$node] == self::NODE_VISITED) {
                continue;
            }
            
            $this->nodes[$node] = self::NODE_VISITED;
            $this->logger->add("Посещена вершина: " . ($node + 1));
            
            for ($j = 0; $j <= (count($this->data) - 1); $j++) {
                if (isset($this->data[$node][$j]) && $this->data[$node][$j] == self::NODE_NOT_VISITED 
                        && isset($this->nodes[$j]) && $this->nodes[$j] == self::NODE_NOT_FINDED) {
                    $this->Queue->enqueue($j);
                    $this->nodes[$j] = self::NODE_NOT_VISITED;
                    $this->logger->add("Найдена вершина: " . ($j + 1));

                    $this->buildTrajectory($node, $j);
                    
                    if ($j == $this->end) {
                        break(2);
                    }
                }
            }
        }
        
        $this->analyzeResults();
    }

    public function searchDepth() {
        $this->init();

        $this->logger->add('------------------------------');
        $this->logger->add('');        
        $this->logger->add('Поиск по графу в глубину');        
        
        $this->Stack->push(0);
        while (!$this->Stack->isEmpty()) {
            $node = $this->Stack->pop();

            if (isset($this->nodes[$node]) && $this->nodes[$node] == self::NODE_VISITED) {
                continue;
            }
            
            $this->nodes[$node] = self::NODE_VISITED;
            $this->logger->add("Посещена вершина: " . ($node + 1));
            
            for ($j = (count($this->data) - 1); $j >= 0; $j--) {
                if (isset($this->data[$node][$j]) && $this->data[$node][$j] == self::NODE_NOT_VISITED 
                        && isset($this->nodes[$j]) && $this->nodes[$j] == self::NODE_NOT_FINDED) {
                    $this->Stack->push($j);
                    $this->nodes[$j] = self::NODE_NOT_VISITED;
                    $this->logger->add("Найдена вершина: " . ($j + 1));

                    $this->buildTrajectory($node, $j);
                    
                    if ($j == $this->end) {
                        break(2);
                    }
                }
            }
        }
        
        $this->analyzeResults();
    }    
    
    /**
     * 
     * @param int $begin
     * @param int $end
     */
    private function buildTrajectory(int $begin, int $end) {
        $edge = new Step();
        $edge->begin = $begin;
        $edge->end = $end;
        
        $this->trajectory->push($edge);
    }

    private function analyzeResults() {
        $path = [];
        $path[] = $this->end + 1;
        $this->next = $this->end;

        while (!$this->trajectory->isEmpty()) {
            $edge = $this->trajectory->pop();
            if ($edge->end == $this->next) {
                $this->next = $edge->begin;
                $path[] = $this->next + 1;
            }
        }

        if (count($path) > 1) {
            $path = array_reverse($path);
            $this->logger->add('');
            $this->logger->add("Путь:");
            $this->logger->add(implode(' -> ', $path));
        } else {
            $this->logger->add('');
            $this->logger->add('Путь не существует');
        }
        $this->logger->add('');
        
        $this->printer->set($this->logger->getMessages())->show();
    }

}
