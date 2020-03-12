lize($matches['to']);
                $upperBound = new Constraint('<=', $highVersion);
            } else {
                $highMatch = array('', $matches[10], $matches[11], $matches[12], $matches[13]);
                $highVersion = $this->manipulateVersionString($highMatch, $empty($matches[11]) ? 1 : 2, 1) . '-dev';
                $upperBound = new Constraint('<', $highVersion);
            }

            return array(
                $lowerBound,
                $upperBound,
            );
        }

        // Basic Comparators
        if (preg_match('{^(<>|!=|>=?|<=?|==?)?\s*(.*)}', $constraint, $matches)) {
            try {
                $version = $this->normalize($matches[2]);

                if (!empty($stabilityModifier) && self::parseStability($version) === 'stable') {
                    $version .= '-' . $stabilityModifier;
                } elseif ('<' === $matches[1] || '>=' === $matches[1]) {
                    if (!preg_match('/-' . self::$modifierRegex . '$/', strtolower($matches[2]))) {
                        if (strpos($matches[2], 'dev-') !== 0) {
                            $version .= '-dev';
                        }
                    }
                }

                return array(new Constraint($matches[1] ?: '=', $version));
            } catch (\Exception $e) {
            }
        }

        $message = 'Could not parse version constraint ' . $constraint;
        if (isset($e)) {
            $message .= ': ' . $e->getMessage();
        }

        throw new \UnexpectedValueException($message);
    }

    /**
     * Increment, decrement, or simply pad a version number.
     *
     * Support function for {@link parseConstraint()}
     *
     * @param array $matches Array with version parts in array indexes 1,2,3,4
     * @param int $position 1,2,3,4 - which segment of the version to increment/decrement
     * @param int $increment
     * @param string $pad The string to pad version parts after $position
     *
     * @return string The new version
     */
    private function manipulateVersionString($matches, $position, $increment = 0, $pad = '0')
    {
        for ($i = 4; $i > 0; --$i) {
            if ($i > $position) {
                $matches[$i] = $pad;
            } elseif ($i === $position && $increment) {
                $matches[$i] += $increment;
                // If $matches[$i] was 0, carry the decrement
                if ($matches[$i] < 0) {
                    $matches[$i] = $pad;
                    --$position;

                    // Return null on a carry overflow
                    if ($i === 1) {
                        return null;
                    }
                }
            }
        }

        return $matches[1] . '.' . $matches[2] . '.' . $matches[3] . '.' . $matches[4];
    }

    /**
     * Expand shorthand stability string to long version.
     *
     * @param string $stability
     *
     * @return string
     */
    private function expandStability($stability)
    {
        $stability = strtolower($stability);

        switch ($stability) {
            case 'a':
                return 'alpha';
            case 'b':
                return 'beta';
            case 'p':
            case 'pl':
                return 'patch';
            case 'rc':
                return 'RC';
            default:
                return $stability;
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       filter:
    excluded_paths: [