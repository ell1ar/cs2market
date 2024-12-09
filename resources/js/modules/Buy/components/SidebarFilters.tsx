import { TChangeQueryParamsFn } from "@/modules/Filter/hooks/useQueryFilter";
import { cn } from "@/shared/helpers";
import { Accordion, AccordionItem, Card, Checkbox, CheckboxGroup } from "@nextui-org/react";

type Props = {
    className?: string;
    queryParams: Record<string, any> | null;
    changeQueryParams: TChangeQueryParamsFn;
    checkboxFiltersJson?: Record<string, any>;
};

export default function SidebarFilters({ className, queryParams, changeQueryParams, checkboxFiltersJson }: Props) {
    return (
        <Card className={cn(className)}>
            <Accordion
                selectionMode="multiple"
                isCompact
            >
                {checkboxFiltersJson?.options.map((option: any) => (
                    <AccordionItem
                        key={option.key}
                        aria-label={option.title}
                        title={option.title}
                        classNames={{
                            title: "text-sm",
                        }}
                    >
                        <CheckboxGroup
                            value={queryParams?.[option.key]?.$contains?.split(",") ?? []}
                            onChange={(value) => changeQueryParams({ value: value.join(","), key: option.key }, { isMultiple: true })}
                        >
                            {option?.list?.map((item: any) => (
                                <Checkbox
                                    color="secondary"
                                    key={item.key}
                                    value={item.key}
                                    size="sm"
                                >
                                    {item.title}
                                </Checkbox>
                            ))}
                        </CheckboxGroup>
                    </AccordionItem>
                ))}
            </Accordion>
        </Card>
    );
}
