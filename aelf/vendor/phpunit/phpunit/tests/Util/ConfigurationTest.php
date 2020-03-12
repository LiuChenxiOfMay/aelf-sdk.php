<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Script\Path;

use BitWasp\Bitcoin\Script\Interpreter\Stack;
use BitWasp\Bitcoin\Script\Opcodes;
use BitWasp\Bitcoin\Script\ScriptInterface;

class BranchInterpreter
{

    /**
     * @var array
     */
    private $disabledOps = [
        Opcodes::OP_CAT,    Opcodes::OP_SUBSTR, Opcodes::OP_LEFT,  Opcodes::OP_RIGHT,
        Opcodes::OP_INVERT, Opcodes::OP_AND,    Opcodes::OP_OR,    Opcodes::OP_XOR,
        Opcodes::OP_2MUL,   Opcodes::OP_2DIV,   Opcodes::OP_MUL,   Opcodes::OP_DIV,
        Opcodes::OP_MOD,    Opcodes::OP_LSHIFT, Opcodes::OP_RSHIFT
    ];

    /**
     * @param ScriptInterface $script
     * @return ParsedScript
     */
    public function getScriptTree(ScriptInterface $script): ParsedScript
    {
        $ast = $this->getAstForLogicalOps($script);
        $scriptPaths = $ast->flags();

        $scriptBranches = [];
        if (count($scriptPaths) > 1) {
            foreach ($scriptPaths as $path) {
                $scriptBranches[] = $this->getBranchForPath($script, $path);
            }
        } else {
            $scriptBranches[] = $this->getBranchForPath($script, []);
        }

        return new ParsedScript($script, $ast, $scriptBranches);
    }

    /**
     * Build tree of dependent logical ops
     * @param ScriptInterface $script
     * @return LogicOpNode
     */
    public function getAstForLogicalOps(ScriptInterface $script): LogicOpNode
    {
        $root = new LogicOpNode(null);
        $current = $root;

        foreach ($script->getScriptParser()->decode() as $op) {
            switch ($op->getOp()) {
                case Opcodes::OP_IF:
                case Opcodes::OP_NOTIF:
                    $split = $current->split();
                    $current = $split[$op->getOp() & 1];
                    break;
                case Opcodes::OP_ENDIF:
                    if (null === $current->getParent()) {
                        throw new \RuntimeException("Unexpected ENDIF, current scope had no parent");
                    }
                    $current = $current->getParent();
                    break;
                case Opcodes::OP_ELSE:
                    if (null === $current->getParent()) {
                        throw new \RuntimeException("Unexpected ELSE, current scope had no parent");
                    }
                    $current = $current->getParent()->getChild((int) !$current->getValue());
                    break;
            }
        }

        if (!$current->isRoot()) {
            throw new \RuntimeException("Unbalanced conditional - vfStack not empty at script termination");
        }

        return $root;
    }

    /**
     * Given a script and path, attempt to produce a ScriptBranch instance
     *
     * @param ScriptInterface $script
     * @param bool[] $path
     * @return ScriptBranch
     */
    public function getBranchForPath(ScriptInterface $script, array $path): ScriptBranch
    {
        // parses the opcodes which were actually run
        $segments = $this->evaluateUsingStack($script, $path);

        return new ScriptBranch($script, $path, $segments);
    }

    /**
     * @param Stack $vfStack
     * @param bool $value
     * @return bool
     */
    private function checkExec(Stack $vfStack, bool $value): bool
    {
        $ret = 0;
        foreach ($vfStack as $item) {
            if ($item === $value) {
                $ret++;
            }
        }

        return (bool) $ret;
    }

    /**
     * @param ScriptInterface $script
     * @param int[] $logicalPath
     * @return array - array of Operation[] representing script segments
     */
    public function evaluateUsingStack(ScriptInterface $script, array $logicalPath): array
    {
        $mainStack = new Stack();
        foreach (array_reverse($logicalPath) as $setting) {
            $mainStack->push($setting);
        }

        $vfStack = new Stack();
        $parser = $script->getScriptParser();
        $tracer = new PathTracer();

        foreach ($parser as $i => $operation) {
            $opCode = $operation->getOp();
            $fExec = !$this->checkExec($vfStack, false);

            if (in_array($opCode, $this->disabledOps, true)) {
                throw new \RuntimeException('Disabled Opcode');
            }

            if (Opcodes::OP_IF <= $opCode && $opCode <= Opcodes::OP_ENDIF) {
                switch ($opCode) {
                    case Opcodes::OP_IF:
                    case Opcodes::OP_NOTIF:
                        // <expression> if [statements] [else [statements]] endif
                        $value = false;
                        if ($fExec) {
                            if ($mainStack->isEmpty()) {
                                $op = $script->getOpcodes()->getOp($opCode & 1 ? Opcodes::OP_IF : Opcodes::OP_NOTIF);
                                throw new \RuntimeException("Unbalanced conditional at {$op} - not included in logicalPath");
                            }

                            $value = $mainStack->pop();
                            if ($opCode === Opcodes::OP_NOTIF) {
                                $value = !$value;
                            }
                        }
                        $vfStack->push($value);
                        break;

                    case Opcodes::OP_ELSE:
                        if ($vfStack->isEmpty()) {
                            throw new \RuntimeException('Unbalanced conditional at OP_ELSE');
                        }
                        $vfStack->push(!$vfStack->pop());
                        break;

                    case Opcodes::OP_ENDIF:
                        if ($vfStack->isEmpty()) {
                            throw new \RuntimeException('Unbalanced conditional at OP_ENDIF');
                        }
                        $vfStack->pop();

                        break;
                }

                $tracer->operation($operation);
            } else if ($fExec) {
                // Fill up trace with executed opcodes
                $tracer->operation($operation);
            }
        }

        if (count($vfStack) !== 0) {
            throw new \RuntimeException('Unbalanced conditional at script end');
        }

        if (count($mainStack) !== 0) {
            throw new \RuntimeException('Values remaining after script execution - invalid branch data');
        }

        return $tracer->done();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      INDX( 	 �o	�            (   �  �       ~ �                  �    � l     �    I��#&��d��#&��d��#&��d��#&��        *              B r a n c h I n t e r p r e t e r . p h p     �    p Z     �    I��#&��d��#&��d��#&��d��#&��        *              B R A N C H ~ 1 . P H P       �    p `     �    ^�#&��^�#&��^�#&��^�#&��       k	              L o g i c O p N o d e . p h p �    p Z     �    ^�#&��^�#&��^�#&��^�#&��       k	              L O G I C O  1 . P H P       �    x b     �    "g�#&���;�#&���;�#&���;�#&��       	              P a r s e d S c r i p t . p h p       �    p Z     �    "g�#&���;�#&���;�#&���;�#&��       	              P A R S E D ~ 1 . P H P       �    p ^     �    s�#&��v��#&��v��#&��v��#&��       �              P a t h T r a c e r . p h p   �    p Z     �    s�#&��v��#&��v��#&��v��#&��       �              P A T H T R ~ 1 . P H P       �    x b     �    �)�#&���P�#&� �P�#&���P�#&��       �              S c r i p t B r a n c h . p h p       �    p Z     �    �)�#&���P�#&���P�#&���P�#&��       �              S C R I P T ~ 1 . P H P                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Script\Path;

use BitWasp\Bitcoin\Script\ScriptInterface;

class ParsedScript
{
    /**
     * @var ScriptInterface
     */
    private $script;

    /**
     * @var LogicOpNode
     */
    private $ast;

    /**
     * @var array
     */
    private $descriptorMap;

    /**
     * ParsedScript constructor.
     * @param ScriptInterface $script
     * @param LogicOpNode $ast
     * @param ScriptBranch[] $branches
     */
    public function __construct(ScriptInterface $script, LogicOpNode $ast, array $branches)
    {
        if (!$ast->isRoot()) {
            throw new \RuntimeException("LogicOpNode was not for root");
        }

        $descriptorIdx = 0;
        $keyedIdxMap = []; // descriptor => ScriptBranch
        foreach ($branches as $branch) {
            $descriptor = $branch->getPath();
            $descriptorKey = json_encode($descriptor);
            if (array_key_exists($descriptorKey, $keyedIdxMap)) {
                throw new \RuntimeException("Duplicate logical pathway, invalid ScriptBranch found");
            }

            $keyedIdxMap[$descriptorKey] = $branch;
            $descriptorIdx++;
        }

        $this->descriptorMap = $keyedIdxMap;
        $this->script = $script;
        $this->ast = $ast;
    }

    /**
     * @return bool
     */
    public function hasMultipleBranches()
    {
        return $this->ast->hasChildren();
    }

    /**
     * Returns a list of paths for this script. This is not
     * always guaranteed to be in order, so take care that
     * you actually work out the paths in advance of signing,
     * and hard code them somehow.
     *
     * @return array[] - array of paths
     */
    public function getPaths()
    {
        return array_map(function (ScriptBranch $branch) {
            return $branch->getPath();
        }, $this->descriptorMap);
    }

    /**
     * Look up the branch by it's path
     *
     * @param array $branchDesc
     * @return bool|ScriptBranch
     */
    public function getBranchByPath(array $branchDesc)
    {
        $key = json_encode($branchDesc);
        if (!array_key_exists($key, $this->descriptorMap)) {
            throw new \RuntimeException("Unknown logical pathway");
        }

        return $this->descriptorMap[$key];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             