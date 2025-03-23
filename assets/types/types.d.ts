export type JobListing = {
    jobId: number;
    title: string;
    slug: string;
    employment: {
        name: string;
    }
}

type Meta = {
    code: string;
    message: string
}

export type Pagination = {
    entriesFrom: number;
    entriesSum: number;
    entriesTo: number;
    entriesTotal: number;
}

export type JobListingResponse = {
    payload: null|Array<JobListing>
    meta: Pagination & Meta
}

export type FormField = {
    name: string;
    type: string;
    label: string;
    value: string|int|array|null;
    required: bool;
    options: Record<string, string>;
    hidden: bool;
    order: int;
}

export type FormDefinitionResponse = {
    fields: null|Array<FormField>
}

export type AnswerResponse = {
    meta: Meta
}
