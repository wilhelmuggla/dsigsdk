<?php
/**
 * DsigSdk   the PHP XML Digital Signature recommendation SDK, 
 *           source http://www.w3.org/2000/09/xmldsig#
 *
 * This file is a part of DsigSdk.
 *
 * Copyright 2019 Kjell-Inge Gustafsson, kigkonsult, All rights reserved
 * author    Kjell-Inge Gustafsson, kigkonsult
 * Link      https://kigkonsult.se
 * Package   DsigSdk
 * Version   0.971
 * License   Subject matter of licence is the software DsigSdk.
 *           The above copyright, link, package and version notices,
 *           this licence notice shall be included in all copies or substantial 
 *           portions of the DsigSdk.
 *
 *           DsigSdk is free software: you can redistribute it and/or modify
 *           it under the terms of the GNU Lesser General Public License as published
 *           by the Free Software Foundation, either version 3 of the License,
 *           or (at your option) any later version.
 *
 *           DsigSdk is distributed in the hope that it will be useful,
 *           but WITHOUT ANY WARRANTY; without even the implied warranty of
 *           MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *           GNU Lesser General Public License for more details.
 *
 *           You should have received a copy of the GNU Lesser General Public License
 *           along with DsigSdk. If not, see <https://www.gnu.org/licenses/>.
 */
namespace Kigkonsult\DsigSdk\Dto;

use InvalidArgumentException;
use Webmozart\Assert\Assert;

/**
 * Class ObjectType
 */
class ObjectType extends DsigBase
{

    /**
     * @var Manifest|SignaturePropertiesType|AnyType[]
     *            minOccurs="0" maxOccurs="unbounded" namespace="##any" processContents="lax"
     * @access protected
     */
    protected $objectTypes = [];

    /**
     * Property, get- and setter methods for
     * var string id
     *            attribute name="Id" type="ID" use="optional"
     */
    use Traits\IdTrait;

    /**
     * @var string
     *            attribute name="MimeType" type="string" use="optional"
     * @access protected
     */
    protected $mimeType = null;

    /**
     * @var string
     *            attribute name="Encoding" type="anyURI" use="optional"
     * @access protected
     */
    protected $encoding = null;



    /**
     * @return Manifest|SignaturePropertiesType|AnyType[]
     */
    public function getObjectTypes() {
        return $this->objectTypes;
    }

    /**
     * @param Manifest|SignaturePropertiesType|AnyType[] $objectTypes
     * @return static
     * @throws InvalidArgumentException
     */
    public function setObjectTypes( array $objectTypes ) {
        foreach( $objectTypes as $ix => $element ) {
            if( ! is_array( $element )) {
                $element = [ $ix => $element ];
            }
            foreach( $element as $key => $value ) {
                Assert::string( $key );
                switch( $key ) {
                    case self::MANIFEST :
                        Assert::isInstanceOf( $value, parent::getNs() . self::MANIFEST . parent::$TYPE  );
                        $this->objectTypes[$ix] = $element;
                        break 2;
                    case self::SIGNATUREPROPERTIES :
                        Assert::isInstanceOf( $value, parent::getNs() . self::SIGNATUREPROPERTIES . parent::$TYPE  );
                        $this->objectTypes[$ix] = $element;
                        break 2;
                    case self::ANYTYPE :
                        Assert::isInstanceOf( $value, parent::getNs() . self::ANYTYPE );
                        $this->objectTypes[$ix] = $element;
                        break 2;
                    default :
                        throw new InvalidArgumentException( sprintf( self::$FMTERR1, self::KEYINFO, $ix, $key ));
                        break;
                } // end switch
            } // end foreach
        } // end foreach
        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType() {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     * @return static
     * @throws InvalidArgumentException
     */
    public function setMimeType( $mimeType ) {
        Assert::string( $mimeType );
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding() {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     * @return static
     * @throws InvalidArgumentException
     */
    public function setEncoding( $encoding ) {
        Assert::string( $encoding );
        $this->encoding = $encoding;
        return $this;
    }

}