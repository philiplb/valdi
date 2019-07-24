<?php

/*
 * This file is part of the Valdi package.
 *
 * (c) Philip Lehmann-Böhm <philip@philiplb.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Valdi;

/**
 * To ease the building of the rules array.
 */
class RulesBuilder {

    /**
     * Holds the rules under construction.
     */
    protected $rules;

    /**
     * Creates and returns an instance.
     *
     * @return RulesBuilder
     * the new instance
     */
    public static function create() {
        return new RulesBuilder();
    }

    /**
     * Constructor.
     */
    public function __construct() {
        $this->rules = [];
    }

    /**
     * Adds a rule for a field to the set. This function takes a variable amount
     * of parameters in order to cover the rule parameters. Example for a rule
     * without parameter:
     * addFieldRule('myField', 'required')
     * Example for a rule with two parameters:
     * addFieldRule('myField', 'between', 3, 7)
     *
     * @param string $field
     * the field for the rule
     * @param string $rule
     * the rule to add
     *
     * @return RulesBuilder
     * the instance of the called RulesBuilder in order to chain the rules
     * creation
     */
    public function addFieldRule($field, $rule) {
        if (!isset($this->rules[$field])) {
            $this->rules[$field] = [];
        }
        $newRule = [$rule];
        $numArgs = func_num_args();
        for ($i = 2; $i < $numArgs; ++$i) {
            $newRule[] = func_get_arg($i);
        }
        $this->rules[$field][] = $newRule;
        return $this;
    }

    /**
     * Adds a rule to the set. This function takes a variable amount
     * of parameters in order to cover the rule parameters. Example for a rule
     * without parameter:
     * addRule('required')
     * Example for a rule with two parameters:
     * addRule('between', 3, 7)
     *
     * @param string $rule
     * the rule to add
     *
     * @return RulesBuilder
     * the instance of the called RulesBuilder in order to chain the rules
     * creation
     */
    public function addRule($rule) {
        $newRule = [$rule];
        $numArgs = func_num_args();
        for ($i = 1; $i < $numArgs; ++$i) {
            $newRule[] = func_get_arg($i);
        }
        $this->rules[] = $newRule;

        return $this;
    }

    /**
     * Gets the created rules. Afterwards, the RulesBuilder is emptied and ready to be used again.
     *
     * @return array
     * the created rules
     */
    public function build() {
        $rules = $this->rules;
        $this->rules = [];
        return $rules;
    }

}
