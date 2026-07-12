# SchoolOS Ontology

> *The ontology defines the reality that SchoolOS understands.*

---

# Purpose

The SchoolOS Ontology establishes the conceptual foundation of the SchoolOS universe.

It defines the fundamental entities that exist, the relationships between them, and the principles that govern those relationships.

Its purpose is to ensure that every part of SchoolOS shares the same understanding of reality.

---

# Why Ontology Exists

SchoolOS is designed to support human development within learning communities.

To reason about development, the system must first understand the reality in which development occurs.

Ontology provides that shared understanding.

It answers one fundamental question:

> **What exists in the SchoolOS universe?**

Everything else is built upon this answer.

---

# Scope

The ontology defines concepts.

It does not define software.

Specifically, the ontology does not describe:

- database schemas
- application architecture
- APIs
- user interfaces
- implementation details
- programming languages

Those belong to later stages of the project.

---

# Foundational Principles

## Reality before implementation

The ontology models reality.

Software must adapt to reality, not the other way around.

---

## People before data

People are not records.

Data represents only a limited view of a person's journey.

SchoolOS exists to understand people through meaningful evidence rather than reducing them to isolated data.

---

## Relationships before attributes

Entities gain meaning through their relationships.

Attributes describe.

Relationships explain.

For this reason, relationships are considered first-class citizens within the SchoolOS ontology.

---

## Evidence before conclusions

SchoolOS preserves evidence.

It does not permanently preserve conclusions.

As new evidence emerges, conclusions may change while the evidence remains.

---

## Development is inferred

Development is never stored as an intrinsic property of a person.

It is inferred through reasoning over evidence accumulated across time and contexts.

---

# Core Concepts

The first version of the ontology intentionally contains only a small number of concepts.

Current concepts include:

- Person
- Experience
- Observation
- Evidence
- Development Dimension

Additional concepts should only be introduced when they represent essential aspects of reality that SchoolOS must understand.

---

# Relationship Philosophy

SchoolOS is fundamentally a network of relationships.

Knowledge emerges from connected evidence rather than isolated records.

```
Person
    participates in
Experience
    generates
Observation
    may support
Evidence
    supports
Development Dimension
```

The ontology therefore prioritizes relationships over isolated entities.

---

# Evolution

The ontology is expected to evolve throughout the lifetime of SchoolOS.

However, every change must satisfy the following conditions:

- It reflects reality more accurately.
- It increases conceptual clarity.
- It remains internally consistent.
- It is independent of implementation choices.

No concept should be added merely to simplify software development.

---

# Relationship to Other Documentation

| Document | Purpose |
|----------|---------|
| Manifesto | Why SchoolOS exists |
| Philosophy | What SchoolOS believes |
| Ontology | What exists |
| Knowledge Model | How knowledge is formed |
| Reasoning Model | How reasoning is performed |
| Architecture | How the system is designed |
| Product | How people experience the system |

Each layer depends on the layers above it.

---

# Working Rule

Every proposed concept must answer three questions before becoming part of the ontology.

1. Does this concept exist in reality?
2. Does SchoolOS need to understand it?
3. Can it be defined independently of implementation?

If the answer to any of these questions is **No**, the concept should not become part of the ontology.

---

# Closing Statement

The quality of SchoolOS will never exceed the quality of its ontology.

For this reason, ontology is treated as the permanent conceptual foundation upon which every future architectural, technical, and product decision is built.