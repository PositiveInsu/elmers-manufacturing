<?php

namespace App\Http\Common\Converter\HexadecimalToProperty;

class HexadecimalConverterPropertyDTO
{
    public bool|null $machine_on = null;
    public bool|null $grinding_beans = null;
    public bool|null $empty_grounds_fault = null;
    public bool|null $water_empty_fault = null;
    public int|null $number_of_cups_today = null;
    public bool|null $descale_required = null;
    public bool|null $have_another_one_carl = null;

    public function getMachineOn(): ?bool
    {
        return $this->machine_on;
    }

    public function setMachineOn(?bool $machine_on): HexadecimalConverterPropertyDTO
    {
        $this->machine_on = $machine_on;
        return $this;
    }

    public function getGrindingBeans(): ?bool
    {
        return $this->grinding_beans;
    }

    public function setGrindingBeans(?bool $grinding_beans): HexadecimalConverterPropertyDTO
    {
        $this->grinding_beans = $grinding_beans;
        return $this;
    }

    public function getEmptyGroundsFault(): ?bool
    {
        return $this->empty_grounds_fault;
    }

    public function setEmptyGroundsFault(?bool $empty_grounds_fault): HexadecimalConverterPropertyDTO
    {
        $this->empty_grounds_fault = $empty_grounds_fault;
        return $this;
    }

    public function getWaterEmptyFault(): ?bool
    {
        return $this->water_empty_fault;
    }

    public function setWaterEmptyFault(?bool $water_empty_fault): HexadecimalConverterPropertyDTO
    {
        $this->water_empty_fault = $water_empty_fault;
        return $this;
    }

    public function getNumberOfCupsToday(): ?int
    {
        return $this->number_of_cups_today;
    }

    public function setNumberOfCupsToday(?int $number_of_cups_today): HexadecimalConverterPropertyDTO
    {
        $this->number_of_cups_today = $number_of_cups_today;
        return $this;
    }

    public function getDescaleRequired(): ?bool
    {
        return $this->descale_required;
    }

    public function setDescaleRequired(?bool $descale_required): HexadecimalConverterPropertyDTO
    {
        $this->descale_required = $descale_required;
        return $this;
    }

    public function getHaveAnotherOneCarl(): ?bool
    {
        return $this->have_another_one_carl;
    }

    public function setHaveAnotherOneCarl(?bool $have_another_one_carl): HexadecimalConverterPropertyDTO
    {
        $this->have_another_one_carl = $have_another_one_carl;
        return $this;
    }
}
